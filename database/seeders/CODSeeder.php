<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CODSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CertificateSeeder::class,
            LanguageSeeder::class,
            SetEnrollmentUserNameSeeder::class,
            PlanSeeder::class,
            OrganizationSeeder::class,
            OrgPlanSeeder::class,
            ServerConfigSeeder::class,
            PageSeeder::class,
            SocialMediaSeeder::class,
            ExistsOrgSocialLinksAddSeeder::class,
        ]);
    }
}
