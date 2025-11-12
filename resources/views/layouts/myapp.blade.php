<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BALBINE STORE')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/cropped-logo-odedis-store-32x32.Jpg') }}">
    <meta name="description" content="@yield('description', 'Balbine Store — Produits d\'entretien professionnels et grand public.')">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">

    @stack('styles')
    <script src="{{ asset('js/welcome.js') }}" defer></script>
    @stack('scripts')
</head>

<body>
    @include('partials.header')
    @yield('content')
    @include('partials.mobile-menu')
    @include('partials.contact-sidebar')
    @include('partials.login-sidebar')
    @include('partials.reset-password-sidebar')
    @include('partials.new-password-sidebar')
    @include('partials.wishlist-sidebar')
    @include('partials.cart-sidebar')
</body>

</html>