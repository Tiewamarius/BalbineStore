<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirection...</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f2f4f8;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }

        .box {
            text-align: center;
        }

        h1 {
            font-size: 60px;
            margin-bottom: 10px;
            color: #000000ff;
        }

        p {
            font-size: 20px;
        }

        #counter {
            font-size: 45px;
            font-weight: bold;
            color: #000000ff;
        }
    </style>

    <script>
        let timeLeft = 5;

        function startCountdown() {
            const counterElement = document.getElementById("counter");

            const timer = setInterval(() => {
                counterElement.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(timer);
                    window.location.href = "/";
                }

                timeLeft--;
            }, 1000);
        }

        window.onload = startCountdown;
    </script>

</head>

<body>

    <div class="box">
        <h1>Nous sommes avec vous</h1>
        <p>La page que vous recherchez n'existe pas.</p>
        <p>Redirection dans <span id="counter">5</span> secondes...</p>
    </div>

</body>

</html>