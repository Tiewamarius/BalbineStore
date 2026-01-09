<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle an incoming API login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login'    => ['required', 'string'], // name OR email OR phone
            'password' => ['required', 'string'],
        ]);

        // Recherche par email, phone ou name
        $user = User::where('email', $request->login)
            ->orWhere('phone', $request->login)
            ->orWhere('name', $request->login)
            ->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Identifiants incorrects.'],
            ]);
        }

        if (! $user->is_active) {
            return response()->json([
                'message' => 'Compte désactivé.'
            ], 403);
        }

        // (optionnel) Supprimer anciens tokens
        $user->tokens()->delete();

        // Création du token Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'user'    => $user,
            'token'   => $token,
        ]);
    }

    public function logout(Request $request)
    {
        // Supprimer le token courant
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie'
        ], 200);
    }
}
