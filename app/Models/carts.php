<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
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

    public function items()
    {
        return $this->hasMany(cartitems::class, 'cart_id');
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
