<h2>Nouvelle commande reçue</h2>

<p><strong>Client :</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>

@if($order->user->address)
<p><strong>Adresse :</strong>
    {{ $order->user->address->street }},
    {{ $order->user->address->city }},
    {{ $order->user->address->country }}
</p>
@endif

<p><strong>Téléphone :</strong> {{ $order->user->phone ?? 'Non renseigné' }}</p>

<p><strong>Commande :</strong> #{{ $order->order_number }}</p>

<p><strong>Statut du paiement :</strong>
    @if($order->payment_status == 'paid')
    Payé
    @elseif($order->payment_status == 'pending')
    En attente
    @else
    Échoué
    @endif
</p>

<p><strong>Total :</strong> {{ number_format($order->total, 0, ',', ' ') }} FCFA</p>

<h3>Articles :</h3>

<ul style="list-style:none;padding:0;">
    @foreach ($order->items as $item)
    <li style="margin-bottom:15px; display:flex; align-items:center; gap:10px;">

        {{-- Image produit --}}
        @if($item->product->images->first())
        <img src="{{ asset($item->product->images->first()->image_path) }}"
            alt="Image produit"
            width="80"
            style="border-radius:5px; border:1px solid #ddd;">
        @endif

        <div>
            <strong>{{ $item->product->name }}</strong><br>
            Quantité : x{{ $item->quantity }}<br>
            Prix : {{ number_format($item->total_price, 0, ',', ' ') }} FCFA
        </div>

    </li>
    @endforeach
</ul>