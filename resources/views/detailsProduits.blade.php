<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - BALBINE STORE</title>
    <link rel="icon" type="image/png" href="{{ asset('images/cropped-logo-odedis-store-32x32.Jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/detailsProduits.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/welcome.css') }}"> -->
</head>

<body>
    <header class="hero-headerDetail">
        <div class="hero-left">
            <button class="menu-btn" id="menuToggle">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e3e3e3">
                    <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                </svg>
            </button>

            <a class="menu-btn" href=" {{ url('/search') }}">
                <span class="search-text">Que recherchez-vous ?</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e3e3e3">
                    <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                </svg>
            </a>

        </div>
        <a href="{{ url('/') }}">
            <div class="hero-center">
                <h1 class="logo">BALBINE STORE</h1>
            </div>
        </a>
        <div class="hero-right">
            <a href="#" id="contactLinkDesktop">Contactez-nous</a>

            <span class="icon" id="wishlistToggle">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e3e3e3">
                    <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z" />
                </svg>
            </span>
            @guest
            <span class="icon" id="loginToggle">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e3e3e3">
                    <path
                        d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                </svg>
            </span>
            @else
            <a class="menu-btn" href=" {{ url('/compte') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e3e3e3">
                    <path
                        d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                </svg>
                <!-- <span class="search-text">Bienvenue {{ Auth::user()->name }}</span> -->

            </a>
            @endguest

            <span class="icon" id="cartToggle">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#e3e3e3">
                    <path
                        d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                </svg>
                {{-- Affichage du badge du panier uniquement si l'utilisateur est connecté et a des articles --}}
                @auth
                {{-- la logique ci-dessous par votre méthode réelle pour obtenir le compte --}}
                @php

                @endphp
                <span id="cartCount" class="cart-badge">{{ count(session('cart', []))}}</span>
                @endauth
            </span>
        </div>
    </header>
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

            <h1 class="product-name">{{ $product->name }}</h1>
            <p class="product-price">{{ number_format($product->price, 0, ',', ' ') }} XOF</p>

            <div class="cart-quantity-wrapper" data-id="{{ $product->id }}">
                <button class="add-to-cart-btn">Ajouter au panier</button>
            </div>
            <!-- <a href="#" class="contact-advisor-link">Contacter un conseiller</a> -->
            <a href="#" id='btnVoirpanier' class="panier-advisor-link">Voir panier</a>

            <div class="product-description">
                <p>{{ Str::limit($product->description, 300, '...') }}</p>
                <button class="view-more-btn">Voir plus</button>
            </div>

            <!-- Accordéons -->
            <div class="accordion">
                <div class="accordion-item">
                    <button class="accordion-header">Sustainability</button>
                    <div class="accordion-content">
                        <p>Produit respectueux de l'environnement.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-header">Product Care</button>
                    <div class="accordion-content">
                        <p>Conserver dans un endroit sec et propre.</p>
                    </div>
                </div>
                <div class="accordion-item">
                    <button class="accordion-header">Services en magasin</button>
                    <div class="accordion-content">
                        <p>Assistance et conseils sur rendez-vous.</p>
                    </div>
                </div>
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

    @include('partials.allModal')


    <script src="{{ asset('js/detailsProduits.js') }}" defer></script>
    <script src="{{ asset('js/welcome.js') }}" defer></script>
</body>

</html>