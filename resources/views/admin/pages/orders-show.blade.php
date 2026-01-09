@extends('admin.AdminDashboard')
@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Commande #{{ $order->order_number }}</h6>

                    <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                        {{ strtoupper($order->payment_status) }}
                    </span>
                </div>
            </div>

            <div class="card-body">
                <div class="row">

                    {{-- CLIENT --}}
                    <div class="col-md-4">
                        <h6 class="text-uppercase text-xs text-muted">Client</h6>
                        <p class="mb-1">
                            <strong>{{ $order->user->name ?? 'Invité' }}</strong>
                        </p>
                        <p class="mb-1 text-sm">{{ $order->user->email ?? '-' }}</p>
                        <p class="mb-0 text-sm">{{ $order->phone }}</p>
                    </div>

                    {{-- LIVRAISON --}}
                    <div class="col-md-4">
                        <h6 class="text-uppercase text-xs text-muted">Livraison</h6>
                        <p class="mb-0">
                            {{ optional($order->user->addresses->first())->city }}
                        </p>
                        <p class="mb-1">{{ optional($order->user->addresses->first())->street }}</p>

                    </div>

                    {{-- STATUT --}}
                    <div class="col-md-4">
                        <h6 class="text-uppercase text-xs text-muted">Statut commande</h6>

                        @php
                        $statusColors = [
                        'pending' => 'secondary',
                        'confirmed' => 'info',
                        'processing' => 'primary',
                        'shipped' => 'warning',
                        'delivered' => 'success',
                        'cancelled' => 'danger',
                        ];
                        @endphp

                        <span class="badge bg-{{ $statusColors[$order->status] ?? 'dark' }}">
                            {{ ucfirst($order->status) }}
                        </span>

                        <p class="text-sm mt-2 mb-0">
                            Date : {{ $order->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- PRODUITS --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Produits commandés</h6>
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th class="text-center">Prix</th>
                                <th class="text-center">Qté</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>

                                <td class="text-center">
                                    {{ number_format($item->unit_price, 0, ',', ' ') }} FCFA
                                </td>

                                <td class="text-center">{{ $item->quantity }}</td>

                                <td class="text-end fw-bold">
                                    {{ number_format($item->total_price, 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ACTIONS + TOTAUX --}}
    <div class="row mt-4 align-items-start">

        {{-- ACTIONS (GAUCHE) --}}
        <div class="col-md-8">
            <div class="d-flex gap-2 align-items-center">

                <a href="{{ asset(url('/admin/all-orders')) }}"
                    class="btn btn-outline-dark">
                    ← Retour aux commandes
                </a>

                {{-- Changer statut --}}
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf
                    @method('PATCH')

                    <select name="status"
                        class="form-select form-select-sm"
                        onchange="this.form.submit()">
                        @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $status)
                        <option value="{{ $status }}"
                            @selected($order->status === $status)>
                            {{ ucfirst($status) }}
                        </option>
                        @endforeach
                    </select>
                </form>

            </div>
        </div>

        {{-- TOTAUX (DROITE) --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>Sous-total</span>
                            <strong>{{ number_format($order->subtotal, 0, ',', ' ') }} FCFA</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>Livraison</span>
                            <strong>{{ number_format($order->shipping_fee, 0, ',', ' ') }} FCFA</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>Taxes</span>
                            <strong>{{ number_format($order->tax, 0, ',', ' ') }} FCFA</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0 border-top">
                            <span class="fw-bold">Total</span>
                            <strong class="text-success">
                                {{ number_format($order->total, 0, ',', ' ') }} FCFA
                            </strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection