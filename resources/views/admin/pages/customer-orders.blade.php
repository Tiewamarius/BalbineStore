@extends('admin.AdminDashboard')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Commandes de {{ $user->name }}</h5>

        <a href="{{ url()->previous() }}"
            class="btn btn-sm btn-outline-secondary">
            ← Retour
        </a>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Commande</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>#{{ $order->order_number }}</td>
                    <td>{{ number_format($order->total,0,',',' ') }} FCFA</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune commande</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection