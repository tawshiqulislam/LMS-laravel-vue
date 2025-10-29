<?php

namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\OrganizationPlan;

class OrganizationPlanRepository extends Repository
{
    public static function model()
    {
        return OrganizationPlan::class;
    }

    public static function storeByRequest($request)
    {
        $isActive = false;
        if (isset($request->is_active)) {
            $isActive = $request->is_active == '1' ? true : false;
        }

        $orgPlansCount = OrganizationPlanRepository::query()->count();

        if ($orgPlansCount < 3) {
            return self::create([
                'title' => $request->title,
                'plan_type' => $request->plan_type,
                'duration' => $request->duration,
                'price' => $request->price,
                'description' => $request->description,
                'is_active' => $isActive,
            ]);
        } else {
            return false;
        }
    }

    public static function updateByRequest($request, $plan)
    {
        $isActive = false;

        if (isset($request->is_active)) {
            $isActive = $request->is_active == '1' ? true : false;
        }

        return self::update($plan, [
            'title' => $request->title,
            'plan_type' => $request->plan_type,
            'duration' => $request->duration,
            'price' => $request->price,
            'description' => $request->description,
            'is_active' => $isActive,
        ]);
    }
}
