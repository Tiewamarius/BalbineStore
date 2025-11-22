<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderitems extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    /**
     * Relations
     */

    // L’article appartient à une commande
    public function order()
    {
        return $this->belongsTo(orders::class);
    }

    // L’article correspond à un produit
    public function product()
    {
        return $this->belongsTo(products::class);
    }

    // L’article peut être lié à une variante
    public function variant()
    {
        return $this->belongsTo(product_variants::class, 'product_variant_id');
    }

    /**
     * Accessors
     */

    public function getFormattedTotalPriceAttribute()
    {
        return number_format($this->total_price, 0, ',', ' ') . ' FCFA';
    }
}
