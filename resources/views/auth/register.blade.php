<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Inscription — Balbine Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg: #0b0b0b;
            --card: #0f0f0f;
            --muted: #bfbfbf;
            --accent: #ffffff;
            --input: #141414
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Inter, system-ui;
            background: var(--bg);
            color: var(--accent);
        }

        .wrap {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px
        }

        .card {
            width: 100%;
            max-width: 440px;
            background: var(--card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.6)
        }

        h1 {
            margin: 0 0 6px;
            font-size: 22px
        }

        p.lead {
            color: var(--muted);
            font-size: 13px;
            margin: 0 0 18px
        }

        label {
            display: block;
            font-size: 13px;
            margin: 10px 0 6px;
            color: var(--muted)
        }

        .input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: var(--input);
            color: #fff;
            font-size: 14px
        }

        .input:focus {
            border-color: rgba(255, 255, 255, 0.15)
        }

        .field {
            margin-bottom: 14px;
            position: relative
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--muted);
            font-size: 14px
        }

        .auth-btn {
            width: 100%;
            padding: 12px;
            background: #fff;
            color: #000;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 10px
        }

        .auth-btn:active {
            transform: translateY(1px)
        }

        .hint {
            text-align: center;
            margin-top: 16px;
            font-size: 13px;
            color: var(--muted)
        }
    </style>
</head>

<body>
    <div class="wrap">
        <main class="card">
            <h1>Créer un compte</h1>
            <p class="lead">Rejoignez Balbine Store dès maintenant</p>

            <form action="{{ route('register') }}" method="POST" id="registerForm" novalidate>
                @csrf

                <div class="field">
                    <label>Nom (ou Prénoms)*</label>
                    <input class="input" type="text" name="name" required placeholder="Votre nom">
                </div>

                <div class="field">
                    <label>Contact*</label>
                    <input class="input" type="tel" name="phone" required placeholder="Contact">
                </div>

                <div class="field">
                    <label>E-mail*</label>
                    <input class="input" type="email" name="email" required placeholder="exemple@domaine.com">
                </div>

                <div class="field">
                    <label>Mot de passe*</label>
                    <input class="input pwd" type="password" name="password" required>
                    <i class="fa-solid fa-eye password-toggle"></i>
                </div>

                <div class="field">
                    <label>Retaper le mot de passe*</label>
                    <input class="input pwd" type="password" name="password_confirmation" required>
                    <i class="fa-solid fa-eye password-toggle"></i>
                </div>

                <button type="submit" class="auth-btn">S'inscrire</button>
                <p class="hint">Déjà un compte ? <a href="{{ route('login') }}" style="color:#fff;text-decoration:underline">Se connecter</a></p>
            </form>
        </main>
    </div>

    <script>
        document.querySelectorAll('.password-toggle').forEach((toggle) => {
            toggle.addEventListener('click', () => {
                const input = toggle.previousElementSibling;
                const isPwd = input.type === "password";

                input.type = isPwd ? "text" : "password";
                toggle.classList.toggle("fa-eye");
                toggle.classList.toggle("fa-eye-slash");
            });
        });
    </script>
</body>

</html>