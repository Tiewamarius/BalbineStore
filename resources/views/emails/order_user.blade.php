<h2>Bonjour {{ $order->user->name }},</h2>

<p>Merci pour votre commande ! Voici les détails :</p>

<p><strong>Commande :</strong> #{{ $order->order_number }}</p>
<p><strong>Total :</strong> {{ number_format($order->total, 0, ',', ' ') }} FCFA</p>

<h3>Articles :</h3>
<ul>
    @foreach ($order->items as $item)
    <li>
        {{ $item->product->name }}
        (x{{ $item->quantity }}) –
        {{ number_format($item->total_price, 0, ',', ' ') }} FCFA
    </li>
    @endforeach
</ul>

<p>Nous vous remercions pour votre confiance.</p>