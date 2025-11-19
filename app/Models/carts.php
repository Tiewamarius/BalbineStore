<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'status', // active, pending, completed
    ];

    /**
     * Relations
     */

    // Un panier appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function items()
    {
        return $this->hasMany(Cart_Items::class, 'cart_id');
    }

    /**
     * Accessors
     */

    // Calcul du total du panier
    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });
    }

    // Nombre total d’articles
    public function getTotalQuantityAttribute()
    {
        return $this->items->sum('quantity');
    }
}
