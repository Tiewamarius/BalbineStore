<header class="hero-header">
    <div class="hero-left">
        <button class="menu-btn" id="menuToggle">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
            </svg>
        </button>

        <a class="menu-btn" href="{{ url('/search') }}">
            <span class="search-text">Que recherchez-vous ?</span>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
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
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                <path d="..." /> <!-- ton path cœur -->
            </svg>
        </span>

        @guest
        <span class="icon" id="loginToggle">
            <svg ...>...</svg>
        </span>
        @else
        <a class="menu-btn" href="{{ url('/compte') }}">
            <svg ...>...</svg>
            <span class="search-text">Bienvenue {{ Auth::user()->name }}</span>
        </a>
        @endguest

        <span class="icon" id="cartToggle">
            <svg ...>...</svg>
            @auth
            <span id="cartCount" class="cart-badge">{{ count(session('cart', []))}}</span>
            @endauth
        </span>
    </div>
</header>