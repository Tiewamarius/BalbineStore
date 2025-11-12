<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BALBINE STORE')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/cropped-logo-odedis-store-32x32.Jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <script src="{{ asset('js/welcome.js') }}" defer></script>
</head>

<body>

    {{-- HEADER & HERO --}}
    @include('partials.header')

    {{-- CONTENU PRINCIPAL --}}
    <main>
        @yield('content')
    </main>

    {{-- MODALES --}}
    @include('partials.sidebar-login')
    @include('partials.sidebar-reset-password')
    @include('partials.sidebar-new-password')
    @include('partials.sidebar-wishlist')
    @include('partials.sidebar-cart')
    @include('partials.sidebar-contact')

    {{-- OVERLAY --}}
    @include('partials.overlay')

</body>

</html>