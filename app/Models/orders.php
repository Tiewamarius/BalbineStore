<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
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


    // La commande est liée à une adresse de livraison ou facturation
    public function addresses()
    {
        return $this->belongsTo(addresses::class);
    }

    // Une commande contient plusieurs articles
    public function items()
    {
        return $this->hasMany(orderitems::class);
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
