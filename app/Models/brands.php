<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'is_active',
    ];

    /**
     * Relations
     */

    // Une marque peut avoir plusieurs produits
    public function products()
    {
        return $this->hasMany(Products::class);
    }

    /**
     * Accessors
     */

    // URL du logo
    public function getLogoUrlAttribute()
    {
        return $this->logo
            ? asset('storage/' . $this->logo)
            : asset('images/default-brand.png');
    }

    /**
     * Scopes
     */

    // Marques actives
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
