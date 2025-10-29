<?php

namespace Database\Seeders;

use App\Models\OrganizationPlan;
use App\Repositories\OrganizationPlanRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrgPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrganizationPlanRepository::query()->updateOrCreate([
            'title' => 'Basic Plan',
        ], [
            'plan_type' => 'monthly',
            'duration' => 30,
            'price' => 50.00,
            'description' => 'This is a basic plan. It has a duration of 30 days and a price of $50.00.',
            'is_active' => true,
        ]);
    }
}
