<h2>Votre commande a été annulée</h2>

<p>Bonjour {{ $order->user->name }},</p>

<p>Votre commande <strong>#{{ $order->order_number }}</strong> a été annulée.</p>

<p><strong>Total remboursé :</strong>
    {{ number_format($order->total, 0, ',', ' ') }} FCFA
</p>

<h3>Détails des articles :</h3>
<ul>
    @foreach ($order->items as $item)
    <li>
        <img src="{{ asset($item->product->image_path) }}" width="50" style="border-radius:5px; margin-right:8px;">
        {{ $item->product->name }} (x{{ $item->quantity }})
    </li>
    @endforeach
</ul>

<p>Si vous avez des questions, répondez directement à cet email.</p>