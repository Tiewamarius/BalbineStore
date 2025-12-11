<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Wave</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #00bfff;
            font-family: Arial, sans-serif;
            color: white;
            text-align: center;
        }

        .qr-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
        }

        img {
            width: 250px;
            height: 250px;
        }
    </style>
</head>

<body>
    <h1>Payez avec Wave</h1>
    <div class="qr-box">
        <img src="{{ asset('Images/cd_Qr.jpg') }}" alt="">
    </div>
    <p>Scannez le code QR avec l'application Wave de votre téléphone pour effectuer le paiement.</p>
    <p>Après paiement, le montant sera confirmé automatiquement.</p>
</body>

</html>