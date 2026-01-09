@extends('admin.AdminDashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            {{-- HEADER --}}
            <div class="card-header pb-0">
                <h5 class="mb-0">Tous les paiements</h5>
            </div>

            <div class="card-body px-0 pb-0">
                <div class="table-responsive">

                    {{-- TOP BAR --}}
                    <div class="dataTable-top d-flex justify-content-between align-items-center px-3">

                        {{-- PER PAGE --}}
                        <form method="GET"
                            action="{{ route('admin.pages.allpayments') }}"
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
                        <form method="GET" action="{{ route('admin.pages.allpayments') }}">
                            <input class="dataTable-input"
                                type="text"
                                name="search"
                                placeholder="Référence, client, commande..."
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
                                <th>Référence</th>
                                <th>Commande</th>
                                <th>Client</th>
                                <th>Méthode</th>
                                <th>Montant</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $payment->reference }}</strong>
                                </td>

                                <td>
                                    #{{ $payment->order->order_number ?? '—' }}
                                </td>

                                <td>
                                    {{ $payment->user->name ?? 'Invité' }}
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ strtoupper($payment->method) }}
                                    </span>
                                </td>

                                <td>
                                    <strong>
                                        {{ number_format($payment->amount, 0, ',', ' ') }} FCFA
                                    </strong>
                                </td>

                                <td>
                                    @php
                                    $paymentColors = [
                                    'paid' => 'success',
                                    'pending' => 'warning',
                                    'failed' => 'danger',
                                    ];
                                    @endphp

                                    <span class="badge bg-{{ $paymentColors[$payment->status] ?? 'secondary' }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $payment->created_at->format('d/m/Y') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    Aucun paiement trouvé
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- PAGINATION --}}
                    <div class="d-flex justify-content-center mt-4">
                        {{ $payments->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection