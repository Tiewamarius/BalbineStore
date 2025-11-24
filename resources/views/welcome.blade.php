<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BALBINE STORE</title>
    <link rel="icon" type="image/png" href="{{ asset('images/cropped-logo-odedis-store-32x32.Jpg') }}">
    <meta name="description" content="Balbine Store — Produits d'entretien professionnels et grand public. Découvrez notre sélection.">
    <meta property="og:title" content="Balbine Store">
    <meta property="og:description" content="Produits d'entretien et matériel professionnel.">
    <meta property="og:image" content="{{ asset('images/BALBINE-STORE-1--1536x768.jpg') }}">
    <meta name="robots" content="index,follow">

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    <section class="hero-banner">
        <!-- <img src="{{ asset('images/2021-12-produits-menagers-1536x959.jpg') }}" alt="Balbine Store Banner" class="hero-bg"> -->
        <video autoplay muted loop playsinline class="hero-bg">
            <source src="{{ asset('Streams/banner.MOV') }}" type="video/mov">
            Votre navigateur ne supporte pas la vidéo.
        </video>
        <video class="hero-bg" autoplay muted loop playsinline>
            <source src="{{ asset('Streams/banner.mov') }}" type="video/mp4">
            <!-- Fallback si la vidéo ne charge pas -->
            Votre navigateur ne supporte pas la vidéo.
        </video>

        <div class="hero-overlay">
            <!-- Header -->
            <header class="hero-header">
                <div class="hero-left">
                    <button class="menu-btn" id="menuToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                        </svg>
                    </button>

                    <a class="menu-btn" href="{{ url('/search') }}">
                        <span class="search-text">Que recherchez-vous ?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                        </svg>
                    </a>
                </div>

                <a href="{{ url('/') }}" class="logo">
                    <div class="hero-center">
                        <img src="{{ asset('/Images/logoBalbineSTORE.png') }}" alt="Balbine Store" class="logo-img">

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
                    <span class="menu-btn" id="loginToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path
                                d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                        </svg>
                    </span>
                    @else
                    <a class="menu-btn" href="{{ url('/compte') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path
                                d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                        </svg>
                    </a>
                    @endguest

                    <span class="icon" id="cartToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path
                                d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                        </svg>

                        @auth
                        @php
                        $cartCount = \App\Models\Carts::where('user_id', auth()->id())
                        ->where('status', 'active')
                        ->withSum('items as total_qty', 'quantity')
                        ->first()
                        ->total_qty ?? 0;
                        @endphp

                        <span id="cartCount" class="cart-badge">{{ $cartCount }}</span>
                        @endauth
                    </span>
                </div>
            </header>
            <div class="hero-content">

                <a href="/#Categories" class="hero-btn">
                    Découvrez nos produits
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION CATEGORIES -->
    <section class="product-selection-section" id="Categories">
        <h2 class="section-title">Explorez les produits d'entretien de vos espaces</h2>

        @if($categories->isEmpty())
        <p class="text-center text-gray-500">Aucune catégorie disponible pour le moment.</p>
        @else
        <div class="product-grid-categories">
            @foreach($categories as $category)
            <div class="product-card">
                <div class="card-image-container">
                    <img src="{{ $category->slug ? asset('storage/' . $category->slug) : asset('images/produc/default.jpg') }}"
                        alt="{{ $category->name }}"
                        class="product-image">
                </div>

                <p class="product-label">{{ $category->name }}</p>

                <!-- Icône + bouton animé -->
                <div class="card-action">
                    <div class="card-icon">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                    <a href="#" class="read-more-btn">VOIR PLUS <i class="fas fa-arrow-right rotate-diagonal"></i></a>
                </div>
            </div>

            @endforeach
        </div>
        @endif
    </section>

    <section class="pubmarketing-section">
        <!-- sectionMarketing -->
        <img src="{{ asset('images/BALBINE-STORE-1--1536x768.jpg') }}" alt="Promotion spéciale" class="pub-image">
    </section>

    <!-- Quelque produit mieux visité-->
    <div class="product-grid">
        @foreach($randomProducts as $randomProduct)
        <a href="{{ url('detailsProduct/' . $randomProduct->id) }}">
            <div class="product-card">
                <div class="product-image-wrapper">
                    <img
                        src="{{ asset('storage/' . ($randomProduct->images->first()->image_path ?? 'images/default.png')) }}"
                        alt="{{ $randomProduct->name }}">

                    @if($randomProduct->is_customizable ?? false)
                    <span class="custom-badge">Personnalisable</span>
                    @endif
                </div>

                <div class="product-info">
                    <p class="product-name">{{ $randomProduct->name }}</p>
                    <p class="product-price">{{ number_format($randomProduct->price, 0, ',', ' ') }} XOF</p>
                </div>

                <button class="wishlist-btn" aria-label="Ajouter aux favoris">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000">
                        <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                    </svg>
                </button>
            </div>
        </a>
        @endforeach
    </div>

    <!-- SECTIONS PAR CATÉGORIE -->
    @foreach($categories as $category)

    @php
    $products = $productsByCategory[$category->slug] ?? collect();

    $bannerImages = [
    'Nettoyages & Entretiens Locaux' => [
    'Images/hygiene-locaux-professionnels-desinfectant.jpg',
    'Images/hygiene-locaux-professionnels-desinfectant.jpg',
    'Images/hygiene-locaux-professionnels-desinfectant.jpg',
    ],
    'Traitement Phytosanitaire' => [
    'Images/Cleaning-Chemicals-Washroom-Toilet1.jpg',
    'Images/Cleaning-Chemicals-Washroom-Toilet1.jpg',
    ],
    'Paysagisme & Jardinage' => [
    'Images/csm_2020_Hauert.jpeg',
    'Images/csm_2020_Hauert.jpeg',
    'Images/csm_2020_Hauert.jpeg',
    ],
    "Parfumage d'Espace" => [
    'Images/flacons-parfum-table.jpg',
    'Images/flacons-parfum-table.jpg',
    'Images/flacons-parfum-table.jpg',
    ],
    ];

    // Sécurisation : si slug introuvable → tableau vide
    $images = $bannerImages[$category->name] ?? ['images/default-banner.jpg'];

    // Récupérer une image au hasard
    $banner = $images[array_rand($images)];
    @endphp

    <section class="pubmarketing-section">
        <img src="{{ asset($banner) }}" alt="{{ $category->name }}" class="pub-image">
    </section>

    <center>
        <h2 class="section-title">{{ $category->name }}</h2>
    </center>
    <div class="product-grid">

        @forelse($products as $product)
        <a href="{{ url('detailsProduct/' . $product->id) }}">
            <div class="product-card">
                <div class="product-image-wrapper">
                    <img
                        src="{{ asset('storage/' . ($product->images->first()->image_path ?? 'images/default.png')) }}"
                        alt="{{ $product->name }}">

                    @if($product->is_customizable ?? false)
                    <span class="custom-badge">Personnalisable</span>
                    @endif
                </div>

                <div class="product-info">
                    <p class="product-name">{{ $product->name }}</p>
                    <p class="product-price">{{ number_format($product->price, 0, ',', ' ') }} XOF</p>
                </div>

                <button class="wishlist-btn" aria-label="Ajouter aux favoris">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000">
                        <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                    </svg>
                </button>
            </div>
        </a>
        @empty
        <p class="no-product">Aucun produit disponible dans cette catégorie.</p>
        @endforelse

    </div>
    <div><br><br></div>
    @endforeach
    @include('partials.footer')
    <div class="overlay" id="overlay"></div>

    @include('partials.allModal')


    <script src="{{ asset('js/detailsProduits.js') }}" defer></script>
    <script src="{{ asset('js/welcome.js') }}" defer></script>
    <script src="{{ asset('js/cart.js') }}" defer></script>

</body>

</html>