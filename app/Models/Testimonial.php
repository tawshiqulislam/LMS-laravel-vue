<?php

namespace App\Models;

use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function mediaPath(): Attribute
    {
        $media = asset('assets/images/profile/demo-profile.png');

        if ($this->media && Storage::exists($this->media->src)) {
            $media = Storage::url($this->media->src);
        }

        return Attribute::make(
            get: fn() => $media,
        );
    }
}
