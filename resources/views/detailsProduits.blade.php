<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - BALBINE STORE</title>
    <link rel="icon" type="image/png" href="{{ asset('images/cropped-logo-odedis-store-32x32.Jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/detailsProduits.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>
    <!-- Header -->
    @include('partials.header')
    <!-- SECTION PRODUIT -->
    <section class="product-detail-section">
        <div class="product-images">
            <!-- Image principale -->
            <div class="main-image-wrapper">
                @if($product->images->count())
                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}"
                    alt="{{ $product->name }}" class="main-image">
                @else
                <img src="{{ asset('images/no-image.png') }}" alt="Aucune image" class="main-image">
                @endif
            </div>

            <!-- Miniatures -->
            <div class="thumbnail-list">
                @foreach($product->images as $image)
                <img src="{{ asset('storage/' . $image->image_path) }}"
                    class="thumb {{ $loop->first ? 'active' : '' }}"
                    alt="Vue {{ $loop->iteration }}">
                @endforeach
            </div>
        </div>

        <div class="product-info">
            @if($product->is_new)
            <p class="product-status">Nouveau</p>
            @endif

            <h1 class="product-name" style="margin-bottom: 20px;">{{ $product->name }}</h1>
            <p class="product-price" style="margin-bottom: 20px;">{{ number_format($product->price, 0, ',', ' ') }} XOF</p>

            <div class="cart-quantity-wrapper" data-id="{{ $product->id }}">
                <button class="add-to-cart-btn">Ajouter au panier</button>
            </div>
            <!-- <a href="#" class="contact-advisor-link">Contacter un conseiller</a> -->
            <a href="#" id='btnVoirpanier' onclick="history.back(); return false;" class="panier-advisor-link">Continuer mes achats</a>

            <!-- Accordéons -->
            <div class="accordion">
                <div class="accordion-item">
                    <button class="accordion-header">Descriptions</button>
                    <div class="product-description">
                        <p>{{ Str::limit($product->description, 300, '...') }}</p>
                        <button class="view-more-btn">Voir plus</button>
                    </div>
                    <div class="accordion-content">
                        @php
                        $limited = Str::limit($product->slug, 300, '...');
                        $parts = explode(';', $limited);
                        @endphp
                        <ul>
                            @foreach ($parts as $part)
                            <li>{{ trim($part) }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
                <!--<div class="accordion-item">-->
                <!--    <button class="accordion-header">Product Care</button>-->
                <!--    <div class="accordion-content">-->
                <!--        <p>Conserver dans un endroit sec et propre.</p>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="accordion-item">-->
                <!--    <button class="accordion-header">Services en magasin</button>-->
                <!--    <div class="accordion-content">-->
                <!--        <p>Assistance et conseils sur rendez-vous.</p>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </section>

    <!-- SECTION PRODUITS COMPLÉMENTAIRES -->
    <section class="product-selection-section">
        <h2 class="section-title">Produits complémentaires</h2>
        <div class="product-grid">
            @foreach($relatedProducts as $related)
            <a href="{{ route('product.show', $related->id) }}">
                <div class="product-card">
                    <div class="product-image-wrapper">
                        @if($related->images->count())
                        <img src="{{ asset('storage/' . $related->images->first()->image_path) }}"
                            alt="{{ $related->name }}" class="product-image">
                        @endif
                    </div>
                    <p class="product-label">{{ $related->name }}</p>
                    <p class="product-price">{{ number_format($related->price, 0, ',', ' ') }} XOF</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <section class="pubmarketing-section">
        <img src="{{ asset('images/BALBINE-STORE-1--1536x768.jpg') }}" alt="Promotion spéciale" class="pub-image">
    </section>
    <div class="overlay" id="overlay"></div>

    @include('partials.AuthModal')
    @include('partials.cart-sidebar')


    <script src="{{ asset('js/detailsProduits.js') }}" defer></script>
    <script src="{{ asset('js/welcome.js') }}" defer></script>
    <script src="{{ asset('js/cart.js') }}" defer></script>
</body>

</html>