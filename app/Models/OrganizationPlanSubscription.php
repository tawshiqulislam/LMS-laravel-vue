<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPlanSubscription extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'organization_plan_subscriptions';

    protected $casts = [
        'expires_at' => 'datetime',
        'subscribed_at' => 'datetime',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function plan()
    {
        return $this->belongsTo(OrganizationPlan::class, 'organization_plan_id');
    }
}
