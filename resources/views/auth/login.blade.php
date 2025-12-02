 <!doctype html>
 <html lang="fr">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width,initial-scale=1">
     <title>Connexion — Balbine Store</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <meta name="description" content="Page de connexion, simple et accessible">
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

         html,
         body {
             height: 100%;
             margin: 0;
             font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
             background: var(--bg);
             color: var(--accent);
         }

         .wrap {
             min-height: 100%;
             display: grid;
             place-items: center;
             padding: 32px
         }

         .card {
             width: 100%;
             max-width: 420px;
             background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
             border: 1px solid rgba(255, 255, 255, 0.04);
             padding: 28px;
             border-radius: 12px;
             box-shadow: 0 6px 30px rgba(0, 0, 0, 0.6)
         }

         .brand {
             display: flex;
             gap: 12px;
             align-items: center;
             margin-bottom: 18px
         }

         .logo {
             width: 44px;
             height: 44px;
             border-radius: 8px;
             background: #fff;
             color: #000;
             display: flex;
             align-items: center;
             justify-content: center;
             font-weight: 700
         }

         h1 {
             font-size: 20px;
             margin: 0 0 6px
         }

         p.lead {
             margin: 0;
             color: var(--muted);
             font-size: 13px
         }

         form {
             margin-top: 18px
         }

         label {
             display: block;
             font-size: 13px;
             margin-bottom: 8px;
             color: var(--muted)
         }

         .input,
         .input[type=email],
         .input[type=password],
         .input[type=text] {
             width: 100%;
             padding: 12px 40px 12px 12px;
             border-radius: 8px;
             border: 1px solid rgba(255, 255, 255, 0.06);
             background: var(--input);
             color: var(--accent);
             outline: none;
             font-size: 14px
         }

         .input:focus {
             box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.02);
             border-color: rgba(255, 255, 255, 0.12)
         }

         .field {
             margin-bottom: 14px;
             position: relative
         }

         .password-field {
             display: flex
         }

         .password-toggle {
             position: absolute;
             right: 10px;
             top: 50%;
             transform: translateY(-50%);
             background: transparent;
             border: none;
             color: var(--muted);
             cursor: pointer;
             padding: 6px;
             border-radius: 6px
         }

         .password-toggle:focus {
             outline: 2px solid rgba(255, 255, 255, 0.06)
         }

         .row {
             display: flex;
             justify-content: space-between;
             align-items: center;
             margin-bottom: 16px
         }

         .forgot-password-link {
             font-size: 13px;
             color: var(--muted);
             text-decoration: none
         }

         .forgot-password-link:hover {
             text-decoration: underline
         }

         .auth-btn {
             width: 100%;
             padding: 12px;
             border-radius: 10px;
             border: none;
             background: var(--accent);
             color: #000;
             font-weight: 600;
             cursor: pointer;
             font-size: 15px
         }

         .auth-btn:active {
             transform: translateY(1px)
         }

         .hint {
             font-size: 13px;
             color: var(--muted);
             text-align: center;
             margin-top: 12px
         }

         .divider {
             height: 1px;
             background: rgba(255, 255, 255, 0.03);
             margin: 18px 0;
             border-radius: 2px
         }

         .error {
             color: #ff6b6b;
             font-size: 13px;
             margin-top: 8px
         }

         /* Modal (forgot password) */
         .modal-backdrop {
             position: fixed;
             inset: 0;
             background: rgba(0, 0, 0, 0.6);
             display: none;
             align-items: center;
             justify-content: center;
             padding: 20px
         }

         .modal {
             max-width: 480px;
             width: 100%;
             background: var(--card);
             padding: 20px;
             border-radius: 10px;
             border: 1px solid rgba(255, 255, 255, 0.04)
         }

         .modal h3 {
             margin: 0 0 10px
         }

         .modal .actions {
             display: flex;
             gap: 8px;
             justify-content: flex-end;
             margin-top: 14px
         }

         .btn-ghost {
             background: transparent;
             border: 1px solid rgba(255, 255, 255, 0.06);
             padding: 8px 12px;
             border-radius: 8px;
             color: var(--muted);
             cursor: pointer
         }

         .btn-primary {
             background: var(--accent);
             color: #000;
             border: none;
             padding: 8px 12px;
             border-radius: 8px;
             cursor: pointer
         }

         @media (max-width:480px) {
             .card {
                 padding: 20px;
                 border-radius: 10px
             }
         }
     </style>
 </head>

 <body>
     <div class="wrap">
         <main class="card" role="main">
             <div class="brand">
                 <div class="logo" aria-hidden="true">B</div>
                 <div>
                     <h1>Se connecter</h1>
                     <p class="lead">Accédez à votre compte Balbine Store</p>
                 </div>
             </div>

             <form action="{{ route('login') }}" method="POST" id="loginForm" novalidate>
                 @csrf

                 <div class="field">
                     <label for="login-email">E-mail*</label>
                     <input class="input" type="email" id="login-email" name="email" value="{{ old('email') }}" required placeholder="exemple@domaine.com" aria-describedby="emailHelp">
                     @error('email')
                     <div class="error">{{ $message }}</div>
                     @enderror
                 </div>

                 <div class="field" style="margin-bottom:6px;">
                     <label for="login-password">Mot de passe*</label>
                     <div style="position:relative">
                         <input class="input" type="password" id="login-password" name="password" required aria-describedby="passwordHelp">
                         <i class="fa-solid fa-eye password-toggle"></i>
                     </div>
                     @error('password')
                     <div class="error">{{ $message }}</div>
                     @enderror
                 </div>

                 <div class="row">
                     <div style="font-size:13px;color:var(--muted)">
                         <label style="display:flex;gap:8px;align-items:center"><input type="checkbox" name="remember" style="transform:scale(1.05)"> Se souvenir</label>
                     </div>

                     <a href=" {{ route('password.email') }}" class="forgot-password-link" id="openForgot">Mot de passe oublié ?</a>
                 </div>

                 <button type="submit" class="auth-btn">M'identifier</button>

                 <div class="divider" aria-hidden></div>
                 <p class="hint">Pas encore de compte ? <a href="{{ route('register') }}" style="color:var(--accent);text-decoration:underline">Créer un compte</a></p>
             </form>
         </main>
     </div>

     <!-- Modal: Forgot password -->
     <div class="modal-backdrop" id="modalBackdrop" aria-hidden="true">
         <div class="modal" role="dialog" aria-modal="true" aria-labelledby="forgotTitle">
             <h3 id="forgotTitle">Réinitialiser le mot de passe</h3>
             <p style="color:var(--muted);font-size:14px;margin:6px 0 12px">Entrez votre e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>

             <form id="forgotForm" action="{{ route('password.email') }}" method="POST">
                 @csrf
                 <label for="forgot-email">E-mail</label>
                 <input id="forgot-email" name="email" type="email" class="input" required placeholder="exemple@domaine.com">
                 <div class="actions">
                     <button type="button" class="btn-ghost" id="closeForgot">Annuler</button>
                     <button type="submit" class="btn-primary">Envoyer le lien</button>
                 </div>
             </form>
         </div>
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