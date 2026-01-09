<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\orders;
use App\Models\payments;
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
        $pendingOrdersCount = orders::where('status', 'pending')->count();;


        return view('admin.pages.allOrders', compact('orders', 'pendingOrdersCount'));
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
    public function updateStatus(Request $request, Orders $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        // Si la commande est livrée / payée
        if ($request->status === 'delivered') {

            // 🎯 Paiement terminé
            if ($order->payment) {
                $order->payment->update(['status' => 'completed']);
            } else {
                payments::create([
                    'order_id' => $order->id,
                    'method'   => $order->payment_method ?? 'cash',
                    'amount'   => $order->total,
                    'status'   => 'completed',
                ]);
            }

            // Mise à jour résumé commande
            $order->update(['payment_status' => 'paid']);

            // 🔄 Décrémentation du stock des produits
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->decrement('stock', $item->quantity); // décrémente le stock
                }
            }
        }

        return back()->with('success', 'Commande mise à jour avec succès et stock ajusté');
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
