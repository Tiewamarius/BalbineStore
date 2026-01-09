<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\orders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminProfileController extends Controller
{
    // Afficher le formulaire de profil
    public function edit()
    {

        $pendingOrdersCount = orders::where('status', 'pending')->count();
        return view('admin.profileAdmin', compact('pendingOrdersCount'));
    }

    // Mettre à jour le profil (nom, email)
    public function update(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
        ]);

        $admin->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    // Mettre à jour le mot de passe
    public function updatePassword(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        // Vérifier mot de passe actuel
        if (!Hash::check($request->current_password, $admin->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Le mot de passe actuel est incorrect.'],
            ]);
        }

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Mot de passe mis à jour avec succès.');
    }
}
