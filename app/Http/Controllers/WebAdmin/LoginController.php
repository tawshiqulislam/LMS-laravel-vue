<?php

namespace App\Http\Controllers\WebAdmin;

use App\Events\MailSendEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\InstructorStoreRequest;
use App\Models\Instructor;
use App\Models\User;
use App\Repositories\AccountActivationRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use App\Repositories\VerifyOtpRepository;
use App\Rules\PhoneNumber;
use Carbon\Carbon;
use FontLib\Table\Type\loca;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->email_verified_at != null) {
            if (Auth::user()->is_admin && Auth::user()->hasRole('admin')) {
                return to_route('admin.dashboard');
            }
            if (Auth::user()->hasRole('instructor')) {
                return to_route('instructor.dashboard');
            }
        }

        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = UserRepository::query()
            ->where('email', $request->email)
            ->withTrashed()
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        if ($user && !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'The password you entered is incorrect.',
            ])->onlyInput('password');
        }

        if ($user && $user->deleted_at !== null) {
            $message = "We hope this message finds you well. We are writing to inform you that your account with <span class='fw-bold text-primary'>" . config('app.name') . "</span> has been temporarily suspended as of <span class='fw-bold'>" . Carbon::parse($user->deleted_at)->format('F j, Y') . "</span>. This decision was made in accordance with our policies to ensure the safety, integrity, and proper use of our platform.";

            return to_route('admin.login')->with('account-suspended', $message);
        }

        // Check organization by domain
        $host = $request->getSchemeAndHttpHost();


        if ($user->instructor || $user->hasRole('instructor')) {
            $orgDomain = $user->instructor->organization?->domain;

            if ($orgDomain && $orgDomain != $host) {
                return back()->withErrors([
                    'email' => 'You can only login from your organization domain.',
                ])->onlyInput('email');
            }

            if (!$orgDomain && $host != config('app.url')) {
                return back()->withErrors([
                    'email' => 'You are not authorized to access this area.',
                ])->onlyInput('email');
            }
        } else if ($user->organization && $user->hasRole('organization')) {
            $host = $request->getSchemeAndHttpHost();
            $rootHost = config('app.url');

            if ($host !== $rootHost) {
                $orgDomain = $user->organization->domain;

                // Case 1: Organization has a domain
                if ($orgDomain && $orgDomain != $host) {
                    return back()->withErrors([
                        'email' => 'You can only login from your organization domain.',
                    ])->onlyInput('email');
                }

                // Case 2: Organization domain is null
                if (is_null($orgDomain)) {
                    return back()->withErrors([
                        'email' => 'You can only login from the main site.',
                    ])->onlyInput('email');
                }
            }
        }

        if (Auth::attempt($credentials)) {
            // Retrieve the authenticated user
            $user = UserRepository::query()
                ->where('email', $request->email)
                ->where('deleted_at', null)
                ->first();

            Auth::login($user, true);
            $request->session()->regenerate();

            // Redirect based on user role
            if ($user->is_admin && $user->hasRole('admin')) {
                return to_route('admin.dashboard');
            } else if ($user->is_org && $user->organization) {
                return to_route('org.dashboard');
            } else if ($user->hasRole('instructor') || $user->instructor) {
                return to_route('instructor.dashboard');
            }

            return back()->withErrors([
                'email' => 'You are not authorized to access this area.',
            ])->onlyInput('email');
        }
    }

    public function instructorRegister()
    {
        return view('auth.instructor.register');
    }

    public function instructorAuthenticate(Request $request)
    {
        $host = $request->getSchemeAndHttpHost();
        $organization = OrganizationRepository::query()->where('domain', $host)->first();

        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', 'unique:users,phone',  new PhoneNumber()],
            'password' => 'required',
        ]);

        $password_regex_length = '/^.{8,}/';

        if (!preg_match($password_regex_length, $request->password)) {
            return back()->withErrors([
                'password' => 'Password must be at least 8 characters long.',
            ])->withInput();
        }


        $credentials['password'] = bcrypt($credentials['password']);
        $user = User::create($credentials);
        $user->assignRole('instructor');

        Instructor::create([
            'user_id' => $user->id,
            'organization_id' => $organization ? $organization->id : null,
            'title' => 'Simple Instructor',
            'created_at' => now(),
        ]);

        $otp = rand(111111, 999999);
        $token = Str::random(15);

        VerifyOtpRepository::query()->updateOrCreate([
            'contact' => $user->email,
        ], [
            'otp_code' => $otp,
            'token' => $token
        ]);

        try {
            MailSendEvent::dispatch($otp, $user->email);
            session()->put('verification_token', $token);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }

        return to_route('admin.login')->with('account-created', 'Account created successfully, please check your email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
