<?php

namespace App\Models;

use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $guarded = ['id'];

    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }
}
