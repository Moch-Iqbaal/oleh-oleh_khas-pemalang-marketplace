<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    protected $fillable = [
        'user_id', 'name', 'slug', 'description', 'photo', 'place_name', 'address', 'latitude', 'longitude', 'phone', 'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    // Sama seperti Product::imageUrl(): foto seeder di public/images, foto upload di storage
    public function photoUrl(): ?string
    {
        if (! $this->photo) {
            return null;
        }

        if (str_starts_with($this->photo, 'images/')) {
            return file_exists(public_path($this->photo)) ? asset($this->photo) : null;
        }

        return asset('storage/'.$this->photo);
    }

    public function hasLocation(): bool
    {
        return $this->latitude !== null && $this->longitude !== null;
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('is_verified', true);
    }

    public function mapsUrl(): string
    {
        $query = $this->place_name ? $this->place_name.', Pemalang' : $this->latitude.','.$this->longitude;

        return 'https://www.google.com/maps/search/?api=1&query='.rawurlencode($query);
    }
}
