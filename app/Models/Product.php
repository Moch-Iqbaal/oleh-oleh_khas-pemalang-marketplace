<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'store_id', 'category_id', 'name', 'slug', 'description', 'price', 'stock',
        'weight_grams', 'shelf_life_days', 'is_featured', 'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'weight_grams' => 'integer',
        'shelf_life_days' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Hanya produk dari toko yang sudah diverifikasi yang boleh tampil di etalase
    /**
     * URL gambar produk. Gambar seeder disimpan di public/images (path diawali "images/"),
     * gambar upload ada di disk public (storage). Null kalau tidak ada gambar.
     */
    public function imageUrl(): ?string
    {
        if (! $this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'images/')) {
            return file_exists(public_path($this->image)) ? asset($this->image) : null;
        }

        return asset('storage/'.$this->image);
    }

    public function isUploadedImage(): bool
    {
        return $this->image && ! str_starts_with($this->image, 'images/');
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->whereHas('store', fn ($q) => $q->where('is_verified', true));
    }
}
