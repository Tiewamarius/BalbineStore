<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mot de passe oublié</title>

    <style>
        :root {
            --bg: #0b0b0b;
            --card: #0f0f0f;
            --muted: #bfbfbf;
            --accent: #ffffff;
            --input: #141414;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--accent);
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto;
        }

        .wrap {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px;
        }

        .card {
            width: 100%;
            max-width: 440px;
            background: var(--card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.6);
        }

        h1 {
            margin: 0;
            margin-bottom: 8px;
            font-size: 22px;
        }

        .lead {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 13px;
            color: var(--muted);
        }

        .field {
            margin-bottom: 16px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 13px;
        }

        .input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.06);
            background: var(--input);
            color: #fff;
            font-size: 14px;
        }

        .input:focus {
            border-color: rgba(255, 255, 255, 0.18);
        }

        .auth-btn {
            width: 100%;
            padding: 12px;
            background: #fff;
            color: #000;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            font-size: 15px;
            margin-top: 10px;
        }

        .error-msg {
            font-size: 12px;
            color: #ff6b6b;
            margin-top: 6px;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="card">

            <h1>Mot de passe oublié ?</h1>
            <p class="lead">
                Entrez votre adresse e-mail afin de recevoir un lien de réinitialisation.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="field">
                    <label for="email">E-mail*</label>
                    <input id="email" type="email" name="email" class="input"
                        value="{{ old('email') }}" required autofocus>

                    @error('email')
                    <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="auth-btn">
                    Envoyer le lien de réinitialisation
                </button>
            </form>

        </div>
    </div>
</body>

</html>