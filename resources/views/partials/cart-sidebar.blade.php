<!-- Modale Wishlist -->
<aside class="contact-sidebar login-sidebar" id="wishlistSidebar">
    <header class="contact-header">
        <h2 class="contact-title">Ma Liste de Souhaits</h2>
        <button id="closeWishlistSidebar" class="close-btn" aria-label="Fermer la wishlist">
            &times;
        </button>
    </header>
    <div class="contact-body">
        <div class="not-logged">
            <p>Connectez-vous pour voir votre liste de souhaits.</p>
            <button class="auth-btn" data-modal="login">Se connecter</button>
        </div>
    </div>
</aside>


<!-- Modale Panier -->
<aside class="contact-sidebar cart-sidebar" id="cartSidebar">
    <header class="contact-header">
        <h2 class="contact-title">Mon Panier</h2>
        <button id="closeCartSidebar" class="close-btn" aria-label="Fermer le panier">&times;</button>
    </header>

    <div class="contact-body">

        @guest
        <!-- Panier non connecté -->
        <div class="not-logged">
            <p>Connectez-vous pour accéder à votre panier.</p>
            <button class="checkout-btn open-login-modal" data-modal="login">
                Se connecter pour commander
            </button>
        </div>
        @else
        @php
        $cart = \App\Models\Carts::with('items.product')
        ->where('user_id', auth()->id())
        ->where('status', 'active')
        ->first();
        @endphp

        @if($cart && $cart->items->count())
        <div class="cart-items">
            @foreach($cart->items as $item)
            <div class="cart-item" data-id="{{ $item->product->id }}">
                <img src="{{ asset('storage/' . $item->product->images->first()->image_path) }}"
                    alt="{{ $item->product->name }}"
                    class="cart-item-img">
                <div class="cart-item-info">
                    <h4 class="cart-item-name">{{ $item->product->name }}</h4>
                    <p class="cart-item-price">{{ number_format($item->unit_price, 0, ',', ' ') }} XOF</p>
                    <div class="cart-item-qty">
                        <button class="qty-btn decrease" data-id="{{ $item->product->id }}">−</button>
                        <span class="quantity">{{ $item->quantity }}</span>
                        <button class="qty-btn increase" data-id="{{ $item->product->id }}">+</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="cart-footer">
            <p class="cart-total">
                Total : <strong>{{ number_format($cart->total, 0, ',', ' ') }} XOF</strong>
            </p>
            <a href="{{ route('checkout') }}" class="checkout-btn">Commander</a>
        </div>
        @else
        <!-- Panier vide -->
        <div class="empty-cart">
            <p>Votre panier est vide pour le moment.</p>
        </div>
        @endif
        @endguest
    </div>
</aside>