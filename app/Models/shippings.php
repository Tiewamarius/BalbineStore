<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shippings extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'carrier',        // ex: DHL, La Poste
        'tracking_number',
        'status',         // processing, shipped, delivered
        'shipping_fee',
    ];

    /**
     * Relations
     */

    // Une livraison appartient à une commande
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    /**
     * Accessors
     */

    public function getFormattedFeeAttribute()
    {
        return number_format($this->shipping_fee, 0, ',', ' ') . ' FCFA';
    }

    /**
     * Scopes
     */

    public function scopeShipped($query)
    {
        return $query->where('status', 'shipped');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }
}
