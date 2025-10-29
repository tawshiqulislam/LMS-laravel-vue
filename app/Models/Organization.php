<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organizations';

    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organizationPlanSubscription()
    {
        return $this->belongsTo(OrganizationPlanSubscription::class);
    }

    public function organizationPlanSubscriptions(): HasMany
    {
        return $this->hasMany(OrganizationPlan::class, 'organization_plan_subscriptions');
    }
}
