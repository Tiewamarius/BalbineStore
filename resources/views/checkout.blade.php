<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>- BALBINE STORE</title>
    <link rel="icon" type="image/png" href="{{ asset('images/cropped-logo-odedis-store-32x32.Jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/detailsProduits.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <style>
        :root {
            --primary-color: #000;
            --secondary-color: #6c757d;
            --background-color: #f8f9fa;
            --card-background: #ffffff;
            --success-color: #12d3f1df;
            --font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            font-family: var(--font-family);
            color: #343a40;
        }

        .header-placeholder {
            height: 80px;
            width: 100%;
        }

        .checkout-container {
            padding: 20px 0;
            max-width: 1200px;
            margin: 0 auto;
        }

        .checkout-container h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
            font-size: 2em;
        }

        .checkout-wrapper {
            display: flex;
            gap: 30px;
            padding: 0 20px;
            align-items: flex-start;
        }

        .checkout-form {
            flex: 2;
            background-color: var(--card-background);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .checkout-form h3 {
            color: var(--primary-color);
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        .checkout-form label {
            display: block;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
            font-size: 0.9em;
        }

        /* --------------- */
        .payment-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin: 15px 0;
        }

        .payment-card {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            transition: 0.25s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            background: #fff;
        }

        .payment-card:hover {
            border-color: #2d8cff;
            background: #f4f9ff;
        }

        .payment-card img {
            width: 50px;
            height: 50px;
        }

        .payment-card input[type="radio"] {
            display: none;
        }

        .payment-card.active {
            border-color: #2d8cff;
            background: #e8f3ff;
            box-shadow: 0 0 10px rgba(45, 140, 255, 0.4);
        }

        /* -------------- */
        .checkout-form input[type="text"],
        .checkout-form textarea,
        .checkout-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
        }

        .checkout-btn {
            width: 100%;
            background-color: var(--success-color);
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            margin-top: 30px;
            transition: 0.3s ease;
        }

        .checkout-summary {
            flex: 1;
            background-color: var(--card-background);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 110px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.95em;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.2em;
            font-weight: bold;
            color: #343a40;
        }

        @media (max-width: 992px) {
            .checkout-wrapper {
                flex-direction: column;
                padding: 0 15px;
            }

            .checkout-summary {
                margin-top: 30px;
                position: static;
            }
        }
    </style>
</head>

<body>

    @include('partials.header')
    <div class="header-placeholder"></div>

    <div class="checkout-container">
        <h2>Finaliser votre commande</h2>

        <div class="checkout-wrapper">

            <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST" class="checkout-form">
                @csrf

                <h3>Informations personnelles</h3>

                <label>Nom complet</label>
                <input type="text" name="fullname" value="{{ Auth::user()->name }}" required>

                <label>Téléphone</label>
                <input type="text" name="phone" value="{{ Auth::user()->phone }}" required>

                <!-- Vérifier si l'utilisateur a une adresse -->
                @if(session('new_address'))
                <label>Adresse complète de livraison</label>
                <textarea name="delivery_address" rows="2" required></textarea>
                <label>Code postal</label>
                <input type="text" name="postal_code" placeholder="Code postal (facultatif)">

                <label>Ville</label>
                <input type="text" name="city" placeholder="Exemple: Abidjan" required>

                <label>Pays</label>
                <input type="text" name="country" value="Côte d'Ivoire" readonly>
                @else
                <!-- Afficher l'adresse existante -->
                <p><strong>Adresse de livraison :</strong> {{ $address->street }}, {{ $address->city }}, {{ $address->country }}</p>
                <input type="hidden" name="address_id" value="{{ $address->id }}">
                @endif

                <h3>Moyen de paiement</h3>

                <div class="payment-cards">

                    <label class="payment-card">
                        <input type="radio" name="payment_method" value="mtn" required>
                        <img src="{{ asset('Images/payments/mtn-mobile-money-logo.png') }}" alt="MTN Money">
                        <span>MTN Mobile Money</span>
                    </label>

                    <label class="payment-card">
                        <input type="radio" name="payment_method" value="orange">
                        <img src="/images/payments/Orange_Money_Logo.png" alt="Orange Money">
                        <span>Orange Money</span>
                    </label>

                    <label class="payment-card">
                        <input type="radio" name="payment_method" value="wave">
                        <img src="/Images/payments/wave-mobile-money-logo.png" alt="Wave Money">
                        <span>Wave Money</span>
                    </label>

                    <label class="payment-card">
                        <input type="radio" name="payment_method" value="cash">
                        <img src="/images/payments/cash-icon-transparent-19.png" alt="Paiement à la livraison">
                        <span>Paiement à la livraison</span>
                    </label>

                </div>
                <!-- <h3>Moyen de paiement</h3>

                <div class="payment-options">

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="mtn" required>
                        <span>MTN Mobile Money</span>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="orange">
                        <span>Orange Money</span>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="wave">
                        <span>Wave Money</span>
                    </label>

                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="cash">
                        <span>Paiement à la livraison <img src="Images/logoCash.jpg" alt=""></span>
                    </label>

                </div>
 -->

                <button type="submit" class="checkout-btn">Confirmer et payer</button>
            </form>

            <div class="checkout-summary">
                <h3>Votre commande</h3>

                @foreach($cart['items'] as $item)
                <div class="summary-item">
                    <span>{{ $item['product']['name'] }}</span>
                    <span>{{ $item['quantity'] }} × {{ number_format($item['unit_price'], 0, ',', ' ') }} F</span>
                </div>
                @endforeach

                <hr>

                <p class="summary-total">
                    Total :
                    <strong>{{ number_format($cart['total'], 0, ',', ' ') }} F</strong>
                </p>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('checkoutForm');
            const paymentSelect = document.getElementById('paymentMethod');

            form.addEventListener('submit', async (e) => {
                const paymentMethod = paymentSelect.value;

                // Si méthode de paiement spéciale → empêcher submit normal
                if (['wave', 'mtn', 'orange', 'cash'].includes(paymentMethod)) {
                    e.preventDefault();

                    // Empêcher double-submit
                    form.querySelector('button[type="submit"]').disabled = true;

                    const formData = new FormData(form);

                    try {
                        const res = await fetch("{{ route('checkout.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: formData
                        });

                        const data = await res.json();

                        if (!data.order_id) {
                            alert(data.error || "Erreur lors de la création de la commande.");
                            form.querySelector('button[type="submit"]').disabled = false;
                            return;
                        }

                        const orderId = data.order_id;

                        // Redirection selon mode de paiement
                        const redirectRoutes = {
                            wave: `/wave/pay/${orderId}`,
                            mtn: `/mtn/pay/${orderId}`,
                            orange: `/orange/pay/${orderId}`,
                            cash: `/compte`
                        };

                        window.location.href = redirectRoutes[paymentMethod];

                    } catch (error) {
                        console.error(error);
                        alert("Erreur réseau. Vérifiez votre connexion.");
                        form.querySelector('button[type="submit"]').disabled = false;
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {

            // Effet card active
            const cards = document.querySelectorAll('.payment-card');
            cards.forEach(card => {
                card.addEventListener('click', () => {
                    cards.forEach(c => c.classList.remove('active'));
                    card.classList.add('active');
                });
            });

            // Gestion du submit pour paiement dynamique
            const form = document.getElementById('checkoutForm');

            form.addEventListener('submit', function(e) {
                const checked = document.querySelector('input[name="payment_method"]:checked');
                if (!checked) return;

                const paymentMethod = checked.value;

                // Paiement à la livraison → soumission normale
                if (paymentMethod === 'cash') return;

                // Wave, MTN, Orange → Ajax
                e.preventDefault();

                const formData = new FormData(form);

                fetch("{{ route('checkout.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {

                        if (!data.order_id) {
                            alert(data.error || "Erreur lors de la création de la commande.");
                            return;
                        }

                        const orderId = data.order_id;

                        // Redirections
                        if (paymentMethod === 'wave') window.location.href = `/wave/pay/${orderId}`;
                        if (paymentMethod === 'mtn') window.location.href = `/mtn/pay/${orderId}`;
                        if (paymentMethod === 'orange') window.location.href = `/orange/pay/${orderId}`;

                    })
                    .catch(err => {
                        console.error(err);
                        alert("Erreur serveur.");
                    });
            });

        });
    </script>

</body>

</html>