<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'method',        // ex: card, cash, mobile money
        'amount',
        'status',        // pending, completed, failed, refunded
        'transaction_id', // optionnel
    ];

    /**
     * Relations
     */

    // Un paiement appartient à une commande
    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    /**
     * Accessors
     */

    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 0, ',', ' ') . ' FCFA';
    }

    /**
     * Scopes
     */

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
