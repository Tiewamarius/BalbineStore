<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addresses extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'street',
        'city',
        'postal_code',
        'country',
        'phone',
    ];

    /**
     * Relations
     */

    // Une adresse appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accesseurs et méthodes utilitaires
     */

    public function isShipping()
    {
        return $this->type === 'shipping';
    }

    public function isBilling()
    {
        return $this->type === 'billing';
    }
}
