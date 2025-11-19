@extends('layouts.myapp')

@section('content')

<div class="checkout-success">
    <h2>Votre commande a été enregistrée !</h2>

    <p>Merci <strong>{{ $order->fullname }}</strong>, nous avons bien reçu votre commande.</p>

    <p>Montant à payer : <strong>{{ number_format($order->total, 0, ',', ' ') }} F</strong></p>

    <p>Méthode : <strong>{{ strtoupper($order->payment_method) }} Money</strong></p>

    <h3>Détails :</h3>
    <ul>
        @foreach($order->items as $item)
        <li>{{ $item->quantity }} × {{ $item->product->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('products.index') }}" class="btn">Continuer vos achats</a>
</div>

@endsection