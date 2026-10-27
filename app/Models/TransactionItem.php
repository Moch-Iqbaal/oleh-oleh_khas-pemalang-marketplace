<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionItem extends Model
{
    protected $fillable = ['transaction_id', 'product_id', 'qty', 'price'];

    protected $casts = ['price' => 'decimal:2', 'qty' => 'integer'];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function subtotal(): float
    {
        return $this->qty * (float) $this->price;
    }
}
