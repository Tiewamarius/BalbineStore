@extends('layouts.myapp')

@section('content')

<style>
    body {
        padding-top: 100px;
        /* Ajuste selon la hauteur exacte de ton header */
    }

    @media (max-width: 768px) {
        body {
            padding-top: 120px;
            /* Si ton header mobile est plus haut */
        }
    }

    /* ===== Affichage produits en 2 colonnes sur mobile ===== */
    @media (max-width: 600px) {

        .order-product {
            flex-direction: row;
            width: 48%;
            /* pour 2 colonnes */
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #eee;
            border-radius: 10px;
        }

        /* Conteneur pour activer 2 colonnes */
        .card-body {
            display: flex;
            flex-wrap: wrap;
            gap: 4%;
        }

        .order-product img {
            width: 70px;
            height: 70px;
        }

        .order-product-info h5 {
            font-size: .9rem;
        }

        .order-product-info p {
            font-size: .85rem;
        }
    }

    /* ===================================== */
    /* ========== ORDER DETAILS PAGE ======= */
    /* ===================================== */

    .order-layout {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-top: 4rem;
    }

    @media (max-width: 850px) {
        .container {
            margin: 5px;
        }

        .order-layout {

            grid-template-columns: 1fr;
        }
    }

    .container {
        margin: 10px;
    }

    /* Card générale */
    .order-card {
        border: 1px solid #eaeaea;
    }

    .order-card .card-header {
        font-weight: 600;
        padding: 1rem 1.2rem;
    }

    /* Badge statuts cohérents */
    .badge-success {
        background: #4CAF50 !important;
    }

    .badge-warning {
        background: #ffc107 !important;
        color: #212529 !important;
    }

    .badge-danger {
        background: #e53935 !important;
    }

    /* ===== Liste des produits ===== */

    .order-product {
        display: flex;
        gap: 15px;
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
        align-items: center;
    }

    .order-product img {
        width: 90px;
        height: 90px;
        border-radius: 8px;
        border: 1px solid #ddd;
        object-fit: cover;
    }

    .order-product-info h5 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    /* ===== Récapitulatif à droite ===== */

    .summary-card p {
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }

    .summary-total {
        font-size: 1.2rem;
        font-weight: 700;
        margin-top: 1rem;
    }

    /* ===== Boutons fixes ===== */

    .fixed-bottom-buttons {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 15px;
        z-index: 9999;
    }

    .fixed-bottom-buttons .btn {
        padding: 10px 18px;
        font-size: 0.9rem;
        border-radius: 8px;
    }

    @media (max-width: 600px) {
        .order-product {
            flex-direction: column;
            align-items: flex-start;
        }

        .order-product img {
            width: 100%;
            height: auto;
        }

        .fixed-bottom-buttons {
            flex-direction: column;
            bottom: 15px;
            width: 90%;
        }

        .fixed-bottom-buttons .btn {
            width: 100%;
        }
    }
</style>


<div class="container my-5">

    <h2 class="mb-4">Commande #{{ $order->id }}</h2>

    <!-- Layout en 2 colonnes -->
    <div class="order-layout">

        <!-- COLONNE GAUCHE : ARTICLES -->
        <div class="card shadow-sm order-card">
            <div class="card-header bg-secondary text-white">
                Articles commandés
            </div>
            <div class="card-body">

                @foreach ($order->items as $item)
                <div class="order-product">

                    <!-- Image produit -->
                    <img src="{{ $item->product->images->first()?->url ?? asset('images/default-product.png') }}"
                        alt="{{ $item->product->name }}">

                    <!-- Infos produit -->
                    <div class="order-product-info">
                        <h5>{{ $item->product->name }}</h5>

                        @if($item->variant)
                        <p class="mb-0">Variante : {{ $item->variant->size }}</p>
                        @endif

                        <p class="mb-0">Quantité :
                            <strong>{{ $item->quantity }}</strong>
                        </p>

                        <p class="mb-0">Prix :
                            <strong>{{ number_format($item->unit_price, 0, ',', ' ') }} FCFA</strong>
                        </p>
                    </div>

                </div>
                @endforeach

            </div>
        </div>

        <!-- COLONNE DROITE : RÉCAP -->
        <div class="card shadow-sm order-card summary-card">
            <div class="card-header bg-primary text-white">
                Récapitulatif
            </div>
            <div class="card-body">

                <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y à H:i') }}</p>

                <p><strong>Statut :</strong>
                    <span class="badge badge-{{ strtolower($order->status) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>

                <p class="summary-total">
                    Total : {{ number_format($order->subtotal, 0, ',', ' ') }} FCFA
                </p>

            </div>
        </div>

    </div>

</div>

<!-- Boutons fixes -->
<div class="fixed-bottom-buttons">
    <a href="{{ route('orders.index') }}" class="btn btn-Back">Back</a>

    @if($order->status !== 'paid')
    <a href="{{ route('checkout', $order->id) }}" class="btn btn-Paid">Payer</a>
    @endif
</div>

@endsection