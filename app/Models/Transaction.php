<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class)->withTrashed();
    }
    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class);
    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
    public function organizationPlan(): BelongsTo
    {
        return $this->belongsTo(OrganizationPlan::class);
    }
}
