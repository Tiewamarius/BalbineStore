<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;

use App\Models\notifications;
use Carbon\Carbon;
use App\Models\orders;
use DB;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Tableau de bord

    public function homes(Request $request)
    {
        // 📅 Filtres date
        $startDate = $request->start_date
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();

        $endDate = $request->end_date
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth();

        // 📦 Total ventes payées
        $totalSales = orders::where('payment_status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total');

        // 🧾 Nombre total de commandes
        $totalOrders = orders::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        // 👥 Nombre de clients uniques
        $totalClients = orders::whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');

        // 📈 Ventes aujourd’hui
        $todaySales = orders::whereDate('created_at', Carbon::today())
            ->where('payment_status', 'paid')
            ->sum('total');

        // 📊 Données du graphique (ventes par jour)
        $salesChart = orders::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total')
        )
            ->where('payment_status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Récupérer les notifications les plus récentes avec l'utilisateur
        $notifications = notifications::with('user')
            ->latest()
            ->take(20)
            ->get();

        // commande en attente
        $pendingOrdersCount = orders::where('status', 'pending')->count();;

        return view('admin.dashboard', compact(
            'todaySales',
            'totalSales',
            'totalOrders',
            'totalClients',
            'salesChart',
            'startDate',
            'endDate',
            'pendingOrdersCount',
            'notifications'
        ));
    }


    // LIST
    public function index()
    {
        $admins = Admin::latest()->paginate(5);
        $pendingOrdersCount = orders::where('status', 'pending')->count();;

        return view('admin.index', compact('admins','pendingOrdersCount'));
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
            'password' => 'required|min:8|confirmed',
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
