<?php

namespace App\Http\Controllers\WebAdmin;

use App\Events\MailSendEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\AccountActivationRepository;
use App\Repositories\UserRepository;
use App\Repositories\VerifyOtpRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->cat_search ? strtolower($request->cat_search) : null;
        $organization = app()->bound('currentOrganization') ? app('currentOrganization') : null;
        $instructor = auth()->user()->instructor ?? null;

        $usersQuery = UserRepository::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->where('is_admin', false)
            ->where('is_developer', false)
            ->where('is_root', false)
            ->where('is_org', false)
            ->whereDoesntHave('instructor')
            ->whereDoesntHave('organization');

        if ($organization && !auth()->user()->hasRole('instructor')) {
            $usersQuery->where('student_organization_id', $organization->id);
        } else if ($instructor && auth()->user()->hasRole('instructor')) {
            $usersQuery->whereHas('enrollments', function ($q) use ($instructor) {
                $q->whereHas('course', function ($qc) use ($instructor) {
                    $qc->where('instructor_id', $instructor->id);
                });
            });
        } else {
            $usersQuery->whereNull('student_organization_id');
        }

        $users = $usersQuery
            ->latest('id')
            ->withTrashed()
            ->paginate(25)
            ->withQueryString();


        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function admin()
    {

        $users = UserRepository::query()
            ->where('is_admin', true)
            ->where('is_developer', false)
            ->where('is_root', true)
            ->withTrashed()
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('user.admin', [
            'users' => $users,
        ]);
    }

    public function subAdmin()
    {
        $users = UserRepository::query()
            ->where('is_admin', true)
            ->withTrashed()
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('user.admin', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request)
    {
        $newUser = UserRepository::storeByRequest($request);

        // Set account activation and admin status
        if (isset($request->is_active)) {
            $isActive = $request->is_active == 'on' ? true : false;
            if ($isActive == true) {
                $newUser->update([
                    'email_verified_at' => now()
                ]);
            }
        } else {
            $isActive = false;

            $otp = rand(111111, 999999);
            $token = Str::random(15);

            AccountActivationRepository::create([
                'user_id' => $newUser->id,
                'code' => $otp,
                'valid_until' => now()->addHour(),
            ]);

            VerifyOtpRepository::query()->updateOrCreate([
                'contact' => $newUser->email,
            ], [
                'otp_code' => $otp,
                'token' => $token
            ]);

            $newUser->update([
                'email_verified_at' => null
            ]);

            try {
                MailSendEvent::dispatch($otp, $newUser->email);
                session()->put('verification_token', $token);
            } catch (\Exception $e) {
                // dd($e->getMessage());
            }
        }

        if (isset($request->is_admin)) {
            $isAdmin = $request->is_admin == 'on' ? true : false;
            $newUser->assignRole('admin');
        } else {
            $isAdmin = false;
            if ($isAdmin == false) {
                $newUser->removeRole('admin');
            }
        }

        $newUser->update([
            'is_active' => $isActive,
            'is_admin' => $isAdmin,
        ]);

        return to_route('user.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $updatedUser = UserRepository::updateByRequest($request, $user);

        // Set account activation and admin status
        if ($user->email_verified_at == null || $user->is_active == false) {
            $otp = rand(111111, 999999);
            $token = Str::random(15);

            AccountActivationRepository::create([
                'user_id' => $user->id,
                'code' => $otp,
                'valid_until' => now()->addHour(),
            ]);

            VerifyOtpRepository::query()->updateOrCreate([
                'contact' => $user->email,
            ], [
                'otp_code' => $otp,
                'token' => $token
            ]);

            $user->update([
                'email_verified_at' => null
            ]);

            try {
                MailSendEvent::dispatch($otp, $user->email);
                session()->put('verification_token', $token);
            } catch (\Exception $e) {
                // dd($e->getMessage());
            }
        }

        if ($user->is_admin != true) {
            $isAdmin = $request->is_admin == 'on' ? true : false;

            $user->update([
                'is_admin' => $isAdmin,
            ]);

            if ($isAdmin) {
                $user->assignRole('admin');
            } else {
                $user->removeRole('admin');
            }
        }

        return back()->withSuccess('User updated');
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withSuccess('User deleted');
    }

    public function restore(int $id)
    {
        UserRepository::query()->onlyTrashed()->find($id)->restore();

        return redirect()->route('user.index')->withSuccess('User restored');
    }
}
