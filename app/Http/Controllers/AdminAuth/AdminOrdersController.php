<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\orders;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOrdersController extends Controller
{
    /**
     * Liste + recherche + pagination commandes
     */
    public function SearchOrders(Request $request)
    {
        $search  = $request->input('search');
        $perPage = $request->input('per_page', 5);

        $orders = orders::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where('order_number', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.pages.allOrders', compact('orders'));
    }

    /**
     * Détails commande
     */
    public function show(orders $order)
    {
        $order->load('items.product', 'user');

        return view('admin.pages.orders-show', compact('order'));
    }

    /**
     * Update statut commande
     */
    public function updateStatus(Request $request, orders $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Statut mis à jour');
    }

    // Orders dun clients
    public function orders(User $user)
    {
        $orders = $user->orders()
            ->latest()
            ->paginate(5);

        return view('admin.pages.customer-orders', compact('user', 'orders'));
    }




    public function stats()
    {
        $totalClients     = User::count();
        $activeClients    = User::where('is_active', true)->count();
        $inactiveClients  = User::where('is_active', false)->count();

        $topClients = orders::selectRaw('user_id, COUNT(*) as total')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->take(5)
            ->get();

        return view('admin.pages.dashboard', compact(
            'totalClients',
            'activeClients',
            'inactiveClients',
            'topClients'
        ));
    }
}
