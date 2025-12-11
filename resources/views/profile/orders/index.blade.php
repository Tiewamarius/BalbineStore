@extends('layouts.myapp')

@section('content')
<div class="container my-5">

    <h2 class="mb-4">Mes commandes</h2>

    <!-- Filtre par statut -->
    <div class="mb-4 d-flex flex-wrap gap-2">
        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary">Toutes</a>
        <a href="{{ route('orders.index', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning">En attente</a>
        <a href="{{ route('orders.index', ['status' => 'processing']) }}" class="btn btn-sm btn-outline-info">En cours</a>
        <a href="{{ route('orders.index', ['status' => 'paid']) }}" class="btn btn-sm btn-outline-success">Payées</a>
        <a href="{{ route('orders.index', ['status' => 'cancelled']) }}" class="btn btn-sm btn-outline-danger">Annulées</a>
        <a href="{{ route('orders.index', ['status' => 'delivered']) }}" class="btn btn-sm btn-outline-success">Livrées</a>
    </div>

    @if ($orders->isEmpty())
    <p>Vous n'avez encore passé aucune commande.</p>
    @else
    <div class="list-orders">
        @foreach ($orders as $order)
        <div class="card mb-3 shadow-sm order-card">
            <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h5>Commande #{{ $order->id }}</h5>
                    <p class="mb-0">
                        <strong>Date :</strong> {{ $order->created_at->format('d/m/Y à H:i') }}
                    </p>
                    <p class="mb-0">
                        <strong>Total :</strong> {{ number_format($order->total_amount, 0, ',', ' ') }} FCFA
                    </p>
                    <p class="mb-0">
                        <strong>Statut :</strong>
                        <span class="badge badge-{{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                    </p>
                </div>
                <div class="mt-2 mt-md-0">
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">Voir les détails</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection

@push('styles')
<style>
    .container {
        max-width: 900px;
    }

    /* Carte commande */
    .order-card {
        border-radius: 12px;
        overflow: hidden;
    }

    /* Badge statut */
    .badge {
        padding: 5px 12px;
        border-radius: 12px;
        font-size: 0.85rem;
        font-weight: bold;
        color: #fff;
    }

    .badge-pending {
        background-color: #ff9800;
    }

    .badge-paid {
        background-color: #4caf50;
    }

    .badge-cancelled {
        background-color: #f44336;
    }

    .badge-processing {
        background-color: #2196f3;
    }

    .badge-delivered {
        background-color: #009688;
    }

    /* Boutons filtre */
    .btn-outline-primary {
        color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: #fff;
    }

    .btn {
        border-radius: 8px;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .order-card .card-body {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush