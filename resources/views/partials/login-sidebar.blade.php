<aside class="contact-sidebar login-sidebar" id="loginSidebar">
    <header class="contact-header">
        <h2 class="contact-title" id="loginSidebarTitle">Login</h2>
        <button id="closeLoginSidebar" class="close-btn" aria-label="Fermer le panneau de connexion">
            &times;
        </button>
    </header>
    <div class="contact-body">

        <div id="loginView" class="auth-view active">
            <h3 style="font-size: 16px; margin-bottom: 20px;">J'ai déjà un Compte</h3>

            <form action="{{ route('login') }}" method="POST" id="loginForm" novalidate>
                @csrf
                <p style="text-align: right; font-size: 12px; color: #777;">Champs obligatoires*</p>

                <label for="login-email">E-mail*</label>
                <input type="email" id="login-email" name="email" value="{{ old('email') }}" required placeholder="example@email.com">
                @error('email')
                <div class="input-error">{{ $message }}</div>
                @enderror

                <label for="login-password">Mot de passe*</label>
                <div class="password-field" style="position: relative; margin-bottom: 10px;">
                    <input type="password" id="login-password" name="password" required>
                    <span class="password-toggle" role="button" aria-label="Afficher/masquer le mot de passe">...</span>
                </div>
                <a href="#" class="forgot-password-link">Mot de passe oublié ?</a>
                <br>
                @error('password')
                <div class="input-error">{{ $message }}</div>
                @enderror


                <button type="submit" class="auth-btn">M'identifier</button>
            </form>


            <hr class="separator">

            <h3 class="switch-title">Nouveau Client</h3>
            <p class="switch-text">
                Créez votre espace Balbine Store pour une expérience d'achat personnalisée.
            </p>
            <button class="secondary-btn switch-to-register">
                Créer mon compte
            </button>
        </div>


        <div id="registerView" class="auth-view">
            <h3 style="font-size: 16px; margin-bottom: 20px;">Créer mon Compte</h3>

            <form action="{{ route('register') }}" method="POST" id="registerForm">
                @csrf
                <p style="text-align: right; font-size: 12px; color: #777;">Champs obligatoires*</p>

                <label for="register-lastname" style="display: block; font-size: 14px; margin-bottom: 5px;">Nom (ou Prenoms)*</label>
                <input type="text" id="register-lastname" name="name" required placeholder="Votre nom">

                <label for="register-lastname" style="display: block; font-size: 14px; margin-bottom: 5px;">Contact</label>
                <input type="tel" id="register-lastname" name="phone" required placeholder="Contact">

                <label for="register-email" style="display: block; font-size: 14px; margin-bottom: 5px; margin-top: 15px;">E-mail*</label>
                <input type="email" id="register-email" name="email" required placeholder="example@email.com">

                <label for="register-password" style="display: block; font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Mot de passe*</label>
                <div class="password-field" style="position: relative; margin-bottom: 10px;">
                    <input type="password" id="register-password" name="password" required>
                    <span class="password-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#777">
                            <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Z" />
                        </svg>
                    </span>
                </div>
                <label for="register-password" style="display: block; font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Retaper Mot de passe*</label>
                <div class="password-field" style="position: relative; margin-bottom: 10px;">
                    <input type="password" id="register-password" name="password_confirmation" required>
                    <span class="password-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#777">
                            <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Z" />
                        </svg>
                    </span>
                </div>
                <p style="font-size: 12px; color: #777; margin-bottom: 30px;">
                    En créant un compte, vous acceptez nos conditions générales et notre politique de confidentialité.
                </p>

                <button type="submit" class="auth-btn">
                    S'inscrire
                </button>
            </form>


            <hr class="separator">

            <h3 class="switch-title">Déjà client ?</h3>
            <p class="switch-text">
                Si vous avez déjà un compte, identifiez-vous pour continuer.
            </p>
            <button class="secondary-btn switch-to-login">
                M'identifier
            </button>
        </div>
    </div>
    <br>
    <br>
    <br>
</aside>