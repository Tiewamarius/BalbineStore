<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlists extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /**
     * Relations
     */

    // Une wishlist appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une wishlist contient plusieurs produits
    public function products()
    {
        return $this->belongsToMany(Products::class, 'wishlist_product')
            ->withTimestamps();
    }

    /**
     * Méthodes utilitaires
     */

    // Vérifier si un produit est déjà dans la wishlist
    public function hasProduct($productId)
    {
        return $this->products()->where('product_id', $productId)->exists();
    }
}
