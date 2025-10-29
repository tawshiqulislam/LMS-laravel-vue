<?php

namespace Database\Seeders;

use App\Repositories\SubscriberRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakeupSubscriberPlanTitle extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscribers = SubscriberRepository::query()->get();

        foreach ($subscribers as $subscriber) {
            $subscriber->update([
                'plan_title' => $subscriber->plan->title
            ]);
        }
    }
}
