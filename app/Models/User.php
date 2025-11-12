<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les attributs pouvant être remplis en masse (mass assignable).
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'imageProfil',
        'password',
        'is_active',
    ];

    /**
     * Attributs à cacher lors de la sérialisation.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs à caster.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * ======================
     * RELATIONS ELOQUENT
     * ======================
     */

    // Un utilisateur peut avoir plusieurs adresses
    public function addresses()
    {
        return $this->hasMany(addresses::class);
    }

    // Un utilisateur possède un panier
    public function cart()
    {
        return $this->hasOne(Carts::class);
    }

    // Un utilisateur possède une wishlist
    public function wishlist()
    {
        return $this->hasOne(wishlists::class);
    }

    //Un utilisateur peut avoir plusieurs commandes
    public function orders()
    {
        return $this->hasMany(orders::class);
    }

    //Un utilisateur peut laisser plusieurs avis
    public function reviews()
    {
        return $this->hasMany(reviews::class);
    }

    //Un utilisateur peut avoir plusieurs rôles (admin, client, etc.)
    public function roles()
    {
        return $this->belongsToMany(roles::class, 'role_user');
    }

    /**
     *Accessors / Mutators
     */
    public function setPasswordAttribute($value)
    {
        // Hash automatique du mot de passe à la sauvegarde
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Méthode d’aide pour l’image de profil
     */
    public function getProfileImageUrlAttribute()
    {
        return $this->imageProfil
            ? asset('storage/' . $this->imageProfil)
            : asset('images/default-avatar.png');
    }
}
