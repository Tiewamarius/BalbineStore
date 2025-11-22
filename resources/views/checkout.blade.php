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
                @if(Auth::check())
                <p><strong>Nom complet :</strong> {{ Auth::user()->name }}</p>
                <p><strong>Téléphone :</strong> {{ Auth::user()->phone }}</p>
                <p><strong>Adresse :</strong> {{ Auth::user()->address }}</p>
                @else
                <label>Nom complet</label>
                <input type="text" name="fullname" required>

                <label>Téléphone</label>
                <input type="text" name="phone" required>

                <label>Adresse complète</label>
                <textarea name="address" rows="2" required></textarea>
                @endif

                <h3>Moyen de paiement</h3>
                <select id="paymentMethod" name="payment_method" required>
                    <option value="mtn">MTN Mobile Money</option>
                    <option value="orange">Orange Money</option>
                    <option value="wave">Wave Money</option>
                </select>

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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('checkoutForm');
            const paymentSelect = document.getElementById('paymentMethod');

            form.addEventListener('submit', function(e) {
                if (paymentSelect.value === 'wave') {
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
                            if (!data.order_id) return alert(data.error || 'Erreur lors de la création de la commande.');

                            const orderId = data.order_id;
                            const userAgent = navigator.userAgent || navigator.vendor || window.opera;
                            const isMobile = /android|iphone|ipad|ipod/i.test(userAgent);

                            // Redirection Wave
                            window.location.href = `/wave/pay/${orderId}`;
                        })
                        .catch(err => {
                            console.error(err);
                            alert('Erreur lors de la création de la commande.');
                        });
                }
            });
        });
    </script>

</body>

</html>