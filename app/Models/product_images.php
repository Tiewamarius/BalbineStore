<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_images extends Model
{
    use HasFactory;

    protected $table = 'product_images';
    protected $fillable = [
        'product_id',
        'image_path',
        'is_main',
    ];

    /**
     * Relations
     */

    // Une image appartient à un produit
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    /**
     * Accessors
     */

    // Retourne l’URL complète de l’image
    public function getUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : asset('images/default-product.jpg');
    }

    /**
     * Scopes
     */

    // Pour récupérer uniquement l’image principale
    public function scopeMain($query)
    {
        return $query->where('is_main', true);
    }
}
