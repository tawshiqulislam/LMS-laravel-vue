<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPlan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'duration' => 'integer',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organization_plan_subscriptions');
    }
}
