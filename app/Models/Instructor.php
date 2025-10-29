<?php

namespace App\Models;

use App\Models\Scopes\OrganizationScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Instructor extends Model
{
    protected $guarded = ['id'];

    use HasFactory, SoftDeletes;

    protected static function booted()
    {
        static::addGlobalScope(new OrganizationScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed()->withoutGlobalScope(OrganizationScope::class);
    }
    public function organization()
    {
        return $this->belongsTo(organization::class, 'organization_id')->withTrashed();
    }

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function favouriteUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_instructors');
    }

    public function favouriteGuests(): BelongsToMany
    {
        return $this->belongsToMany(Guest::class, 'guest_instructors');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id', 'id');
    }

    public function signature()
    {
        return $this->belongsTo(Media::class, 'signature_id');
    }

    public function signaturePath(): Attribute
    {
        $signature = asset('enrollment/upload.png');

        if ($this->signature && Storage::exists($this->signature->src)) {
            $signature = Storage::url($this->signature->src);
        }

        return Attribute::make(
            get: fn() => $signature,
        );
    }
}
