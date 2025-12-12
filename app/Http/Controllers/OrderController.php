<?php

namespace App\Http\Controllers;

use App\Models\Orders;

use App\Mail\OrderCancelledMail;
use App\Mail\AdminOrderCancelledMail;

use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->orders();

        // Filtre par statut si présent
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->get();

        return view('profile.orders.index', compact('orders'));
    }


    public function show(Orders $order)
    {
        // sécurité : l'user ne peut voir que ses propres commandes
        abort_if($order->user_id !== auth()->id(), 403);

        return view('profile.orders.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Orders::with(['user', 'items.product', 'address'])->findOrFail($id);

        // Vérification limite de 3 jours
        if ($order->created_at->diffInDays(now()) >= 3) {
            return back()->with('error', 'Le délai d\'annulation est dépassé.');
        }

        // Déjà annulée ?
        if ($order->status == 'cancelled') {
            return back()->with('error', 'Cette commande est déjà annulée.');
        }

        // ----- SI PAIEMENT EN LIGNE -----
        if ($order->payment_method === 'online' && $order->payment_status === 'paid') {

            // ICI tu connectes ton API (PayTech, CinetPay, Orange, Wave ...)
            // Exemple générique :
            $refundSuccess = true; // ← tu remplaces par l’API réelle  

            if (!$refundSuccess) {
                return back()->with('error', 'Erreur lors du remboursement automatique.');
            }

            $order->payment_status = 'refunded';
        }

        // Mise à jour du statut
        $order->status = 'cancelled';
        $order->save();

        // Envoi emails
        Mail::to($order->user->email)->send(new OrderCancelledMail($order));
        Mail::to('info@balbine.com')->send(new AdminOrderCancelledMail($order));

        return back()->with('success', 'Votre commande a été annulée et remboursée.');
    }
    public function reorder($id)
    {
        $oldOrder = Orders::with('items.product')->findOrFail($id);

        // Nouveau panier temporaire
        $cart = [
            'items' => [],
            'total' => 0
        ];

        foreach ($oldOrder->items as $item) {
            $cart['items'][] = [
                'product' => [
                    'id' => $item->product->id,
                    'name' => $item->product->name,
                    'price' => $item->unit_price,
                ],
                'quantity' => $item->quantity,
                'unit_price' => $item->unit_price
            ];

            $cart['total'] += $item->unit_price * $item->quantity;
        }

        session(['cart' => $cart]);

        return redirect()->route('checkout');
    }
}
