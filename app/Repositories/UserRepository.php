<?php

namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Enum\MediaTypeEnum;
use App\Http\Requests\StudentRegisterRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Instructor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    public static function model()
    {
        return User::class;
    }

    public static function storeByRequest(UserStoreRequest $request)
    {
        $profilePicture = $request->hasFile('profile_picture') ? MediaRepository::storeByRequest(
            $request->file('profile_picture'),
            'user/profile_picture',
            MediaTypeEnum::IMAGE
        ) : $profilePicture = MediaRepository::storeByPath(
            public_path('media/blank-user.png'), // Path to default image
            'user/profile_picture',
            MediaTypeEnum::IMAGE
        );

        $organization = app()->bound('currentOrganization') ? app('currentOrganization') : null;

        if ($organization) {
            $request->merge(['student_organization_id' => $organization->id]);
        }

        return self::create([
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'name'     => $request->name,
            'student_organization_id' => $request->student_organization_id ?? null,
            'media_id' => $profilePicture ? $profilePicture->id : null,
        ]);
    }

    public static function instructorStoreByRequest(UserStoreRequest $request)
    {
        $profilePicture = $request->hasFile('profile_picture') ? MediaRepository::storeByRequest(
            $request->file('profile_picture'),
            'user/profile_picture',
            MediaTypeEnum::IMAGE
        ) : $profilePicture = MediaRepository::storeByPath(
            public_path('media/blank-user.png'), // Path to default image
            'user/profile_picture',
            MediaTypeEnum::IMAGE
        );
        return self::create([
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'name'     => $request->name,
            'student_organization_id' => $request->student_organization_id ?? null,
            'media_id' => $profilePicture ? $profilePicture->id : null,
        ]);
    }
    public static function storeByStudentRequest(StudentRegisterRequest $request)
    {
        $profilePicture = $request->hasFile('profile_picture') ? MediaRepository::storeByRequest(
            $request->file('profile_picture'),
            'user/profile_picture',
            MediaTypeEnum::IMAGE
        ) : $profilePicture = MediaRepository::storeByPath(
            public_path('media/blank-user.png'), // Path to default image
            'user/profile_picture',
            MediaTypeEnum::IMAGE
        );

        $organization = app()->bound('currentOrganization') ? app('currentOrganization') : null;
        if ($organization) {
            $request->merge(['student_organization_id' => $organization->id]);
        }

        return self::create([
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'name'     => $request->name,
            'student_organization_id' => $request->student_organization_id ?? null,
            'media_id' => $profilePicture ? $profilePicture->id : null,
        ]);
    }

    public static function updateByRequest(UserUpdateRequest $request, User $user)
    {
        $isActive = $user->is_active;

        if (isset($request->is_active)) {
            $isActive = $request->is_active == 'on' ? true : false;
        }

        if ($user->profilePicture) {
            $profilePicture = $request->hasFile('profile_picture') ? MediaRepository::updateByRequest(
                $request->file('profile_picture'),
                $user->profilePicture,
                'user/profile_picture',
                MediaTypeEnum::IMAGE
            ) : $user->profilePicture;
        } else {
            $profilePicture = $request->hasFile('profile_picture') ? MediaRepository::storeByRequest(
                $request->file('profile_picture'),
                'user/profile_picture',
                MediaTypeEnum::IMAGE
            ) : null;
        }

        if ($user->signature) {
            $signature = $request->hasFile('signature') ? MediaRepository::updateByRequest(
                $request->file('signature'),
                $user->signature,
                'user/signature',
                MediaTypeEnum::IMAGE
            ) : $user->signature;
        } else {
            $signature = $request->hasFile('signature') ? MediaRepository::storeByRequest(
                $request->file('signature'),
                'user/signature',
                MediaTypeEnum::IMAGE
            ) : null;
        }

        if ($user->instructor) {
            InstructorRepository::find($user->instructor->id)->update([
                'signature_id' => $signature ? $signature->id : null,
            ]);
        }


        if (isset($request->company_name) || isset($request->about) || isset($request->designation)) {
            $organization = OrganizationRepository::find($user->organization?->id);
            if ($organization) {
                $organization->name = $request->company_name ?? $organization->name;
                $organization->about = $request->about ?? $organization->about;
                $organization->designation = $request->designation ?? $organization->designation;
                $organization->save();
            }
        }

        return self::update($user, [
            'phone'    => $request->phone ?? $user->phone,
            'gender'    => $request->gender ?? $user->gender,
            'about'    => $request->about ?? $user->about,
            'whatsapp'    => $request->whatsapp ?? $user->whatsapp,
            'birthday'    => $request->birthday ?? $user->birthday,
            'email'    => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'name'     => $request->name ?? $user->name,
            'media_id' => $profilePicture ? $profilePicture->id : null,
            'signature_id' => $signature ? $signature->id : null,
            'is_active' => $isActive,
        ]);
    }
}
