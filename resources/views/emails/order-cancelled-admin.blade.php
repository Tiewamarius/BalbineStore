<h2>Commande annulée</h2>

<p><strong>Client :</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>
<p><strong>Commande :</strong> #{{ $order->order_number }}</p>
<p><strong>Total :</strong> {{ number_format($order->total, 0, ',', ' ') }} FCFA</p>

<h3>Adresse de livraison :</h3>
<p>
    {{ $order->address->full_name }} <br>
    {{ $order->address->phone }} <br>
    {{ $order->address->city }}, {{ $order->address->country }}
</p>

<h3>Articles :</h3>
<ul>
    @foreach ($order->items as $item)
    <li>
        <img src="{{ asset($item->product->image_path) }}" width="50" style="border-radius:5px; margin-right:8px;">
        {{ $item->product->name }} (x{{ $item->quantity }})
    </li>
    @endforeach
</ul>