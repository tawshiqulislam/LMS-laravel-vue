<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\OrgPlanTransaction;

class OrgPlanTransactionRepository extends Repository
{
    public static function model()
    {
        return OrgPlanTransaction::class;    
    }
}