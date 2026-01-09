<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'banner_image',
        'description',
        'parent_id',
        'image',
        'is_active',
    ];

    /**
     * Relations
     */

    // Une catégorie peut avoir plusieurs produits
    public function products()
    {
        return $this->hasMany(products::class);
    }

    // Relation pour la catégorie parente
    public function parent()
    {
        return $this->belongsTo(categories::class, 'parent_id');
    }

    // Relation pour les sous-catégories
    public function children()
    {
        return $this->hasMany(categories::class, 'parent_id');
    }

    /**
     * Scopes
     */

    // Pour récupérer uniquement les catégories actives
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessors
     */

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/default-category.jpg');
    }
}
