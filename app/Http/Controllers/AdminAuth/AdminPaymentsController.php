<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\payments;
use App\Models\orders;
use Illuminate\Http\Request;

class AdminPaymentsController extends Controller
{
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $payments = payments::with(['order.user']) // ✅ CHAÎNAGE CORRECT
            ->when($search, function ($query) use ($search) {

                $query->where('method', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")

                    // 🔎 Recherche via commande
                    ->orWhereHas('order', function ($q) use ($search) {
                        $q->where('order_number', 'like', "%{$search}%");
                    })

                    // 🔎 Recherche via client (order → user)
                    ->orWhereHas('order.user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        $pendingOrdersCount = orders::where('status', 'pending')->count();;


        return view('admin.pages.allPayments', compact('payments', 'pendingOrdersCount'));
    }
}
