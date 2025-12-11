<!-- Définir si l'utilisateur est connecté pour le JS -->
<script>
    window.Laravel = {
        isLoggedIn: "{{ auth()->check() ? 'true' : 'false' }}"
    };
</script>
<!-- Modale Panier -->
<div class="contact-body">

    @if(!auth()->check())
    @php
    $cart = session('cart', []);
    @endphp

    @if(count($cart))
    <div class="cart-items">
        @foreach($cart as $id => $item)
        <div class="cart-item" data-id="{{ $id }}">
            <img src="{{ $item['image'] ?? 'images/no-image.png' }}"
                alt="{{ $item['name'] }}" class="cart-item-img">
            <div class="cart-item-info">
                <h4 class="cart-item-name">{{ $item['name'] }}</h4>
                <p class="cart-item-price">{{ number_format($item['price'], 0, ',', ' ') }} XOF</p>
                <div class="cart-item-qty">
                    <button class="qty-btn decrease" data-id="{{ $id }}">−</button>
                    <span class="quantity">{{ $item['quantity'] }}</span>
                    <button class="qty-btn increase" data-id="{{ $id }}">+</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="cart-footer">
        <p class="cart-total">
            Total : <strong>{{ number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 0, ',', ' ') }} XOF</strong>
        </p>
        <a href="{{ route('login') }}" class="checkout-btn">Se connecter pour commander</a>
    </div>
    @else
    <div class="empty-cart">
        <p>Votre panier est vide pour le moment.</p>
    </div>
    @endif

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
            <img src="{{ asset('storage/' . ($item->product->images->first()?->image_path ?? 'images/no-image.png')) }}"
                alt="{{ $item->product->name }}" class="cart-item-img">
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
    <div class="empty-cart">
        <p>Votre panier est vide pour le moment.</p>
    </div>
    @endif
    @endif

</div>