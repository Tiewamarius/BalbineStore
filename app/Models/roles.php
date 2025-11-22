<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relations
     */

    // Plusieurs utilisateurs peuvent avoir un même rôle
    public function users()
    {
        return $this->belongsToMany(user::class, 'role_user');
    }
}
