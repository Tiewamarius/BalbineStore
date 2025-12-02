<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'price',
        'stock',
        'attributes',
        'is_active',
    ];

    protected $casts = [
        'attributes' => 'array',
        'is_active' => 'boolean',
    ];

    // Relation
    public function product()
    {
        return $this->belongsTo(products::class, 'product_id');
    }
    public function images()
    {
        return $this->hasMany(product_images::class, 'product_id');
    }


    // Accessors
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', ' ') . ' FCFA';
    }

    public function getStockStatusAttribute()
    {
        if ($this->stock <= 0) return 'Rupture de stock';
        elseif ($this->stock < 5) return 'Stock limité';
        else return 'En stock';
    }

    // Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
