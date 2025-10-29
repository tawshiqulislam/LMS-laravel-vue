<?php

namespace App\Models;

use App\Enum\MediaTypeEnum;
use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => MediaTypeEnum::class,
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }
}
