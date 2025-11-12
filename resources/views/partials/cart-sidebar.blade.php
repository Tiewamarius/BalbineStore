<aside class="contact-sidebar" id="cartSidebar">
    <header class="contact-header">
        <h2 class="contact-title">Mon panier</h2>
        <button id="closeCartSidebar" class="close-btn">&times;</button>
    </header>
    <div class="contact-body">
        @auth
        @php $cart = session('cart', []); @endphp
        @if(count($cart) > 0)
        <ul class="cart-items">
            @foreach($cart as $product)
            <li class="cart-item">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
                <span>{{ $product['name'] }}</span>
                <span>{{ $product['quantity'] }} x {{ number_format($product['price'], 0, ',', ' ') }} FCFA</span>
                <button class="remove-cart" data-id="{{ $product['id'] }}">✕</button>
            </li>
            @endforeach
        </ul>
        <div class="cart-footer">
            <span>Total: {{ number_format(array_sum(array_map(fn($p)=>$p['price']*$p['quantity'],$cart)),0,',',' ') }} FCFA</span>
            <a href="{{ route('checkout') }}" class="auth-btn">Commander</a>
        </div>
        @else
        <p>Votre panier est vide.</p>
        @endif
        @else
        <p>Veuillez vous connecter pour voir votre panier.</p>
        @endauth
    </div>
</aside>