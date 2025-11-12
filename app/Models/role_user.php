<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    use HasFactory;

    protected $table = 'role_user';

    protected $fillable = [
        'user_id',
        'role_id',
    ];

    public $timestamps = false; // généralement les tables pivot n’ont pas de timestamps

    /**
     * Relations
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Roles::class);
    }
}
