<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',       // info, warning, success, error
        'is_read',    // notification lue ou non
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Relations
     */

    // Une notification appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scopes
     */

    // Notifications non lues
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Notifications lues
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }
}
