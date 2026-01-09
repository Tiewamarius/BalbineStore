<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Residence;
use App\Models\Booking;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminController extends Controller
{ // Tableau de bord
    public function homes()
    {

        return view('admin.dashboard', []);
    }

    // LIST
    public function index()
    {
        $admins = Admin::latest()->paginate(10);
        return view('admin.index', compact('admins'));
    }

    // CREATE VIEW
    public function create()
    {
        return view('admin.AddAdmin');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Admin::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'is_active' => true,
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin créé avec succès');
    }

    // EDIT VIEW
    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    // UPDATE
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($request->only('name', 'email'));

        return back()->with('success', 'Admin mis à jour');
    }

    // DELETE
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return back()->with('success', 'Admin supprimé');
    }

    // ACTIVER / DÉSACTIVER
    public function toggleStatus(Admin $admin)
    {
        $admin->update([
            'is_active' => !$admin->is_active
        ]);

        return back()->with('success', 'Statut modifié');
    }

    // RESET PASSWORD ADMIN
    public function resetPassword(Admin $admin)
    {
        $newPassword = 'admin123'; // ou générer random

        $admin->update([
            'password' => Hash::make($newPassword)
        ]);

        return back()->with('success', "Mot de passe réinitialisé : $newPassword");
    }
}
