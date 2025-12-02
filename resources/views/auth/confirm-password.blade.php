<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmer le mot de passe</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #111;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
            padding: 30px;
            border: 1px solid #000;
            border-radius: 10px;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 22px;
            text-align: center;
            text-transform: uppercase;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 15px 0 5px;
        }

        .password-field {
            position: relative;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #000;
            border-radius: 6px;
            outline: none;
            font-size: 15px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
        }

        .auth-btn {
            width: 100%;
            background: #000;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 25px;
        }

        .auth-btn:hover {
            background: #333;
        }
    </style>
</head>

<body>

    <div class="auth-container">

        <h2>Confirmation Mot de Passe</h2>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <label for="password">Mot de passe</label>
            <div class="password-field">
                <input type="password" id="password" name="password" required autocomplete="current-password">
                <span class="password-toggle" onclick="togglePassword('password', this)">
                    <i class="fa fa-eye"></i>
                </span>
            </div>

            @error('password')
            <small style="color:red;">{{ $message }}</small>
            @enderror

            <button type="submit" class="auth-btn">
                Confirmer
            </button>
        </form>

    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
        function togglePassword(id, el) {
            const input = document.getElementById(id);

            if (input.type === "password") {
                input.type = "text";
                el.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                input.type = "password";
                el.innerHTML = '<i class="fa fa-eye"></i>';
            }
        }
    </script>

</body>

</html>