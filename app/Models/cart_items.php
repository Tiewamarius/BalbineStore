<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_Items extends Model
{
    use HasFactory;

    protected $table = 'cart_items';
    protected $fillable = [
        'cart_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'unit_price',
    ];

    /**
     * Relations
     */

    // Un article appartient à un panier
    public function cart()
    {
        return $this->belongsTo(Carts::class);
    }

    // Un article correspond à un produit
    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    // Optionnellement lié à une variante
    public function variant()
    {
        return $this->belongsTo(Product_Variants::class, 'product_variant_id');
    }

    /**
     * Accessors
     */

    // Prix total de la ligne
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }
}
