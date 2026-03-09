<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'category_id',
        'image',
        'gallery',
        'is_active'
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2'
    ];

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }
}