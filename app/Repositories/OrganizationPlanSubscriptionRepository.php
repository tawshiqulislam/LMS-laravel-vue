<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\OrganizationPlanSubscription;

class OrganizationPlanSubscriptionRepository extends Repository
{
    public static function model()
    {
        return OrganizationPlanSubscription::class;    
    }
}