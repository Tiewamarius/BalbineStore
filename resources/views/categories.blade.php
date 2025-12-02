<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name ?? 'Catégorie' }} - BALBINE STORE</title>
    <link rel="icon" type="image/png" href="{{ asset('images/cropped-logo-odedis-store-32x32.Jpg') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/detailsProduits.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #fff;
            color: #111;
            margin: 0;
            padding: 0;
        }

        /* TOP BAR */
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 40px;
            border-bottom: 1px solid #eee;
        }

        .category-header select {
            border: none;
            font-size: 16px;
            background: none;
            cursor: pointer;
            padding: 5px;
        }

        /* VARIANT CAROUSEL */
        .variant-carousel {
            display: flex;
            gap: 40px;
            padding: 20px 40px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .variant-carousel::-webkit-scrollbar {
            display: none;
        }

        .variant-item {
            text-align: center;
            min-width: 120px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .variant-item img {
            height: 90px;
            object-fit: contain;
            border-radius: 8px;
        }

        .variant-item:hover {
            transform: scale(1.05);
        }

        /* HERO SECTION */
        .hero {
            width: 100%;
            height: 350px;
            background-size: cover;
            background-position: center;
            margin-top: 20px;
        }

        /* PRODUCT GRID */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            padding: 10px;
        }

        .product-card {
            position: relative;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .product-card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100%;
            background: #f8f8f8;
        }

        /* Wishlist heart */
        .wishlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
            color: #444;
        }

        .product-info {
            margin: 15px;
            font-size: 14px;
            line-height: 1.5;
        }

        .product-price {
            margin-top: 5px;
            font-weight: bold;
        }

        .product-info ul {
            margin-top: 5px;
            padding-left: 15px;
            font-size: 13px;
            list-style: disc;
        }
    </style>
</head>

<body>
    <!-- Header -->
    @include('partials.header')

    <!-- TOP BAR -->
    <div class="category-header" style="padding-top: 100px;">
        <div>
            <select id="variant-filter">
                <option value="all">Toutes les variantes</option>
                @foreach($products as $product)
                @foreach($product->variants as $variant)
                <option value="variant-{{ $variant->id }}">{{ $variant->name }}</option>
                @endforeach
                @endforeach
            </select>
        </div>
        <button style="padding:8px 16px;border:1px solid #000;border-radius:30px;background:white;cursor:pointer;">
            Filtrer <i class="fa fa-sliders"></i>
        </button>
    </div>

    <!-- VARIANT CAROUSEL -->
    <div class="variant-carousel">
        @foreach($products as $product)
        @foreach($product->variants as $variant)
        <div class="variant-item" data-variant-id="{{ $variant->id }}">
            <img src="{{ $variant->image_url ?? $product->main_image_url }}"
                alt="{{ $variant->name }}">
            <p>{{ $variant->name }}</p>
        </div>
        @endforeach
        @endforeach

    </div>


    <!-- HERO BANNER -->
    @php
    $categoryName = strtolower($category->name);

    if (str_contains($categoryName, 'nettoy')) {
    $bgImage = 'Images/nettoyage.png';
    } elseif (str_contains($categoryName, 'phyto')) {
    $bgImage = 'Images/phytosanière.jpg';
    } elseif (str_contains($categoryName, 'paysagiste') || str_contains($categoryName, 'paysag')) {
    $bgImage = 'Images/jardin.jpg';
    } elseif (str_contains($categoryName, 'parfum')) {
    $bgImage = 'Images/flacons-parfum-table.jpg';
    } else {
    $bgImage = 'Images/categories/default.jpg';
    }
    @endphp

    <div class="hero" style="background-image:url('{{ asset($bgImage) }}');"></div>

    <!-- PRODUCT GRID -->
    <div class="product-grid" id="product-grid">
        @foreach($products as $product)
        <a href="{{ url('detailsProduct/' . $product->id) }}" class="product-card" data-product-id="{{ $product->id }}" style="text-decoration:none; color:inherit;">

            <span class="wishlist-btn"><i class="fa-regular fa-heart"></i></span>

            <img
                src="{{ asset('storage/' . ($product->images->first()->image_path ?? 'images/default.png')) }}"
                alt="{{ $product->name }}">

            <div class="product-info">
                <div>{{ $product->name }}</div>
                <div class="product-price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</div>

                @if($product->variants->count())
                <ul>
                    @foreach($product->variants as $variant)
                    <li class="variant-item-li" data-variant-id="{{ $variant->id }}">
                        {{ $variant->name }} - {{ number_format($variant->price, 0, ',', ' ') }} FCFA
                        @if(isset($variant->stock))
                        (Stock: {{ $variant->stock }})
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </a>
        @endforeach
    </div>

    <!-- Overlay / Modals -->
    <div class="overlay" id="overlay"></div>
    @include('partials.AuthModal')
    @include('partials.cart-sidebar')

    <!-- JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterSelect = document.getElementById('variant-filter');
            const productGrid = document.getElementById('product-grid');

            // Filtrer les produits selon la variante sélectionnée
            filterSelect.addEventListener('change', () => {
                const value = filterSelect.value;
                const cards = productGrid.querySelectorAll('.product-card');

                cards.forEach(card => {
                    const variants = card.querySelectorAll('.variant-item-li');
                    if (value === 'all') {
                        card.style.display = 'block';
                    } else {
                        let found = false;
                        variants.forEach(v => {
                            if (v.dataset.variantId === value.replace('variant-', '')) {
                                found = true;
                            }
                        });
                        card.style.display = found ? 'block' : 'none';
                    }
                });
            });

            // Click sur carousel variante scroll
            const variantItems = document.querySelectorAll('.variant-item');
            variantItems.forEach(item => {
                item.addEventListener('click', () => {
                    const variantId = item.dataset.variantId;
                    filterSelect.value = 'variant-' + variantId;
                    filterSelect.dispatchEvent(new Event('change'));
                    item.scrollIntoView({
                        behavior: 'smooth',
                        inline: 'center'
                    });
                });
            });
        });
    </script>


    <script src="{{ asset('js/detailsProduits.js') }}" defer></script>
    <script src="{{ asset('js/welcome.js') }}" defer></script>
    <script src="{{ asset('js/cart.js') }}" defer></script>
</body>

</html>