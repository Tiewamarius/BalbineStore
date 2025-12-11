<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',  // Assurez-vous que cette colonne existe dans la table orders
        'order_number',
        'status',       // pending, paid, shipped, delivered, cancelled
        'payment_method',
        'payment_status', // unpaid, paid, refunded
        'subtotal',
        'shipping_fee',
        'total',
    ];

    /**
     * Relations
     */

    // La commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // La commande est liée à une adresse de livraison ou facturation
    public function address()
    {
        return $this->belongsTo(Addresses::class);  // Assurez-vous que la table address existe
    }

    // Une commande contient plusieurs articles
    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    /**
     * Accessors
     */

    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 0, ',', ' ') . ' FCFA';
    }

    /**
     * Scopes
     */

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    /**
     * Méthodes utilitaires
     */

    public static function generateOrderNumber()
    {
        return 'CMD-' . strtoupper(uniqid());
    }
}
