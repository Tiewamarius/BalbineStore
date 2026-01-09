@extends('admin.AdminDashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            {{-- HEADER --}}
            <div class="card-header pb-0">
                <div class="d-lg-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Toutes les commandes</h5>
                </div>
            </div>

            <div class="card-body px-0 pb-0">
                <div class="table-responsive">

                    {{-- TOP BAR --}}
                    <div class="dataTable-top d-flex justify-content-between align-items-center px-3">

                        {{-- PER PAGE --}}
                        <form method="GET" action="{{ route('admin.pages.allorders') }}"
                            class="d-flex align-items-center gap-2">
                            <select name="per_page"
                                class="dataTable-selector"
                                onchange="this.form.submit()">
                                @foreach([5,10,15,20,25] as $size)
                                <option value="{{ $size }}"
                                    {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                    {{ $size }}
                                </option>
                                @endforeach
                            </select>
                            <span>entries per page</span>

                            @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                        </form>

                        {{-- SEARCH --}}
                        <form method="GET" action="{{ route('admin.pages.allorders') }}">
                            <input class="dataTable-input"
                                type="text"
                                name="search"
                                placeholder="Rechercher commande, client, statut..."
                                value="{{ request('search') }}">

                            @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                            @endif
                        </form>
                    </div>

                    {{-- TABLE --}}
                    <table class="table table-flush">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Commande</th>
                                <th>Client</th>
                                <th>Total</th>
                                <th>Paiement</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td><strong>#{{ $order->order_number }}</strong></td>

                                <td>{{ $order->user->name ?? 'Invité' }}</td>

                                <td>
                                    <strong>{{ number_format($order->total, 0, ',', ' ') }} FCFA</strong>
                                </td>

                                <td>
                                    <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>

                                <td>
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
                                </td>

                                <td>{{ $order->created_at->format('d/m/Y') }}</td>

                                <td class="text-end">
                                    <a href="{{ route('admin.orders-show', $order->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Voir
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    Aucune commande trouvée
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- PAGINATION --}}
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection