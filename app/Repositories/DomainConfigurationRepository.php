<?php
namespace App\Repositories;

use Abedin\Maker\Repositories\Repository;
use App\Models\DomainConfiguration;

class DomainConfigurationRepository extends Repository
{
    public static function model()
    {
        return DomainConfiguration::class;    
    }
}