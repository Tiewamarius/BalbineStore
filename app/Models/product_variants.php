<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_variants extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'price',
        'stock',
        'attributes', // ex: {"taille":"1L", "parfum":"citron"}
        'is_active',
    ];

    protected $casts = [
        'attributes' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Relations
     */

    // Une variante appartient à un produit
    public function product()
    {
        return $this->belongsTo(products::class);
    }

    /**
     * Accessors
     */

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', ' ') . ' FCFA';
    }

    public function getStockStatusAttribute()
    {
        if ($this->stock <= 0) {
            return 'Rupture de stock';
        } elseif ($this->stock < 5) {
            return 'Stock limité';
        } else {
            return 'En stock';
        }
    }

    /**
     * Scopes
     */

    // Variantes actives
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
