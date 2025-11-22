<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlists extends Model
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
        return $this->belongsTo(user::class);
    }

    // Une wishlist contient plusieurs produits
    public function products()
    {
        return $this->belongsToMany(products::class, 'wishlist_products', 'wishlist_id', 'product_id');
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
