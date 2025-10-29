<?php

namespace Database\Seeders;

use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization = OrganizationRepository::query()->updateOrCreate(
            [
                'email' => 'org@readylms.com',
            ],
            [
                'name' => 'Organization A',
                'designation' => 'ORG-A Admin',
            ]
        );

        $user = UserRepository::query()->updateOrCreate([
            'email' => 'org@readylms.com',
        ], [
            'name' => 'Organization A',
            'phone' => '011' . rand(100000000, 999999999),
            'is_active' => true,
            'is_admin' => false,
            'is_org' => true,
            'organization_id' => $organization->id,
            'email_verified_at' => now(),
            'password' => Hash::make('secret@org'),
            'remember_token' => Str::random(10),
        ]);

        $organization->user_id = $user->id;
        $organization->save();

        orgSocialLinksCreate($organization->id);

        $user->assignRole('organization');
    }
}
