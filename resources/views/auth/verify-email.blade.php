<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Vérification d'email — Balbine Store</title>
    <style>
        /* ... (Votre CSS reste inchangé) ... */
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --muted: #6b7280;
            --primary: #0e0e0eff;
            --primary-hover: #43e8f48a;
            --success: #16a34a;
            --focus-ring: rgba(99, 102, 241, 0.2);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        html,
        body {
            height: 100%
        }

        body {
            margin: 0;
            background: linear-gradient(180deg, #fbfdff 0%, #f3f7fb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #111827;
        }

        .card {
            width: 100%;
            max-width: 720px;
            background: var(--card);
            box-shadow: 0 6px 24px rgba(15, 23, 42, 0.08);
            border-radius: 12px;
            padding: 28px;
            box-sizing: border-box;
        }

        .intro {
            font-size: 15px;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 18px;
        }

        /* La classe success est maintenant gérée par Laravel via la session */
        .success {
            background: rgba(16, 185, 129, 0.08);
            border: 1px solid rgba(16, 185, 129, 0.16);
            color: var(--success);
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-weight: 600;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 14px;
            flex-wrap: wrap;
        }

        /* Primary button */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px 16px;
            font-size: 14px;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            border: none;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.14);
            transition: background .15s ease, transform .05s ease;
        }

        .btn-primary:hover {
            background: var(--primary-hover)
        }

        .btn-primary:active {
            transform: translateY(1px)
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 6px var(--focus-ring)
        }

        /* Link-style button (logout) */
        .link-btn {
            background: transparent;
            border: none;
            color: var(--muted);
            text-decoration: underline;
            font-size: 14px;
            cursor: pointer;
            padding: 6px;
            border-radius: 6px;
        }

        .link-btn:hover {
            color: #111827
        }

        /* Small helper */
        .small {
            font-size: 13px;
            color: var(--muted);
        }

        @media (max-width:520px) {
            .row {
                flex-direction: column;
                align-items: stretch;
            }

            .link-btn {
                text-align: center
            }
        }
    </style>
</head>

<body>
    <main class="card" role="main" aria-labelledby="pageTitle">
        <h1 id="pageTitle" style="font-size:18px; margin:0 0 8px 0;">Vérifiez votre adresse e-mail</h1>

        <p class="intro">
            Merci pour votre inscription ! Avant de commencer, pouvez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons d'envoyer ? Si vous n'avez pas reçu l'e-mail, nous pouvons vous en renvoyer un.
        </p>

        @if (session('status') == 'verification-link-sent')
        <div class="success" role="status" aria-live="polite">
            Un nouveau lien de vérification a été envoyé à l'adresse e-mail fournie lors de l'inscription.
        </div>
        @endif

        <div class="row">

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-primary">Renvoyer l'email de vérification</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="link-btn">Se déconnecter</button>
            </form>
        </div>

        <p class="small" style="margin-top:16px;">
            Astuce :Si Vous ne voyez rien dans votre boîte de réception, Vérifiez le dossier <bold style="color:black;font-weight:900;">Spam</bold> OU <blod style="color:black;font-weight:900;">la bonne orthographe de l'adresse</bold>.
        </p>
    </main>

</body>

</html>