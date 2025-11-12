<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'Category_id',
        'Brands_id',
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'unit',
        'is_active',
    ];

    /**
     * Relations
     */

    // Un produit appartient à une catégorie
    public function Categories()
    {
        return $this->belongsTo(Categories::class);
    }

    // Un produit appartient à une marque
    public function Brands()
    {
        return $this->belongsTo(Brands::class);
    }

    // Un produit a plusieurs images
    public function images()
    {
        return $this->hasMany(Product_Images::class, 'product_id');
    }

    // Un produit a plusieurs variantes
    public function variants()
    {
        return $this->hasMany(Product_Variants::class);
    }

    // Un produit est dans plusieurs paniers
    public function cartItems()
    {
        return $this->hasMany(Cart_Items::class);
    }

    // Un produit peut appartenir à plusieurs wishlists
    public function wishlists()
    {
        return $this->belongsToMany(Wishlists::class, 'wishlist_product');
    }

    // Un produit a plusieurs avis
    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

    /**
     * Accessors & Mutators
     */

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getStockStatusAttribute()
    {
        return match (true) {
            $this->stock <= 0 => 'Rupture de stock',
            $this->stock < 5 => 'Stock limité',
            default => 'En stock',
        };
    }

    public function getMainImageUrlAttribute()
    {
        $image = $this->images()->where('is_main', true)->first() ?? $this->images()->first();
        return $image ? asset('storage/' . $image->image_path) : asset('images/default-product.jpg');
    }

    /**
     * Scopes
     */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeDiscounted($query)
    {
        return $query->whereNotNull('discount_price');
    }
}
