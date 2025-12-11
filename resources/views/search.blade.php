<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BALBINE STORE - Recherche</title>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detailsProduits.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
    @include('partials.header')


    <div class="search-content">
        <div class="search-input-wrapper sticky-search">
            <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#4a4a4a">
                <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
            </svg>
            <input type="text" placeholder="Rechercher des articles, des prix..." class="search-input-lg">
        </div>


    </div>
    <div id="search-results" class="product-grid" style="margin-top:20px; display:none;">

    </div>


    <div class="product-grid-search">
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
    @include('partials.footer')
    <div class="overlay" id="overlay"></div>

    @include('partials.cart-sidebar')
    @include('partials.AuthModal')

    <script src={{ asset("js/search.js") }} defer></script>
    <script src="{{ asset('js/detailsProduits.js') }}" defer></script>
    <script src="{{ asset('js/welcome.js') }}" defer></script>
    <script src="{{ asset('js/cart.js') }}" defer></script>
</body>

</html>