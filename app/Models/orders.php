<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'order_number',
        'status',          // pending, confirmed, shipped, delivered, cancelled
        'payment_method',  // cash, card, mobile_money
        'payment_status',  // unpaid, paid, refunded (résumé)
        'subtotal',
        'shipping_fee',
        'total',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Commande → Client
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Commande → Adresse
    public function address()
    {
        return $this->belongsTo(Addresses::class);
    }

    // Commande → Articles
    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    // ✅ Commande → Paiement (IMPORTANT)
    public function payment()
    {
        return $this->hasOne(payments::class, 'order_id');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 0, ',', ' ') . ' FCFA';
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS / MÉTIER
    |--------------------------------------------------------------------------
    */

    public static function generateOrderNumber()
    {
        return 'CMD-' . strtoupper(uniqid());
    }

    // ✅ Synchronisation paiement <-> commande
    public function markAsPaid()
    {
        $this->update([
            'payment_status' => 'paid'
        ]);

        if ($this->payment) {
            $this->payment->update([
                'status' => 'completed'
            ]);
        }
    }
}
