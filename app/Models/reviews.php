<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',      // note sur 5
        'comment',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    /**
     * Relations
     */

    // Un avis appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    // Un avis appartient à un produit
    public function product()
    {
        return $this->belongsTo(products::class);
    }

    /**
     * Accessors
     */

    // Formater la note
    public function getFormattedRatingAttribute()
    {
        return number_format($this->rating, 1) . '/5';
    }

    // Statut de visibilité lisible
    public function getVisibilityStatusAttribute()
    {
        return $this->is_visible ? 'Publié' : 'En attente';
    }

    /**
     * Scopes
     */

    // Avis visibles
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
}
