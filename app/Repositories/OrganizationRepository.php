<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\Organization;

class OrganizationRepository extends Repository
{
    public static function model()
    {
        return Organization::class;    
    }
}