    <!-- Menu-Mobile -->
    <nav class="mobile-menu" id="mobileMenu">
        <header>
            <span>CATEGORIES</span>
            <button id="closeMenu">✕</button>
        </header>
        <ul>
            <li><a href="{{ route('category.categories', 1) }}">Nettoyages & Entretiens Lacaux</a></li>
            <li><a href="{{ route('category.categories', 2) }}">Traitement Phytosanitaire</a></li>
            <li><a href="{{ route('category.categories', 3) }}">Paysagisme & Jardinage</a></li>
            <li><a href="{{ route('category.categories', 4) }}">Parfumage d'Espace</a></li>
            <li><a href="https://www.balbine.net" target="_blank">LES SERVICES BALBINE.NET</a></li>
            <!-- <li><a href="#">Écologiques</a></li> -->
        </ul>
        <div class="footer">
            <p>Besoin d'aide ?</p>
            <a href="tel:+225 0709019999 ">+225 07 09 01 99 99 </a>
        </div>
    </nav>

    <!-- Contact sidebar -->
    <aside class="contact-sidebar" id="contactSidebar">
        <header class="contact-header">
            <h2 class="contact-title">Contactez-nous</h2>
            <button id="closeContactSidebar" class="close-btn" aria-label="Fermer le panneau de contact">
                &times;
            </button>
        </header>

        <div class="contact-body">
            <p class="contact-intro">
                Où que vous soyez, les conseillers clientèle Balbine Store seront ravis de vous aider.
            </p>

            <ul class="contact-options">
                <li>
                    <a href="tel:+225 0143633011">
                        <i class="fas fa-phone-alt"></i><span>+225 0143633011</span>
                    </a>
                </li>

                <li>
                    <a href="mailto:contact@balbine.store">
                        <i class="fas fa-envelope"></i><span>Envoyer un e-mail</span>
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/0143633011" target="_blank">
                        <i class="fab fa-whatsapp"></i> <span> WhatsApp</span>
                    </a>
                </li>
                <li>
                    <a href="https://m.me/votre_page_facebook" target="_blank">
                        <i class=" fab fa-facebook-messenger"></i><span>Facebook Messenger</span>
                    </a>
                </li>

            </ul>

            <div class="contact-footer">
                <a href="#" class="help-link">Besoin d'aide ?</a>
            </div>
        </div>
    </aside>

    <!-- modale login/register -->
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
                    <label for="login-email">E-mail*</label>
                    <input type="email" id="login-email" name="email" value="{{ old('email') }}" required placeholder="example@email.com">

                    <label for="login-password">Mot de passe*</label>
                    <div class="password-field">
                        <input type="password" id="login-password" name="password" required>
                        <span class="password-toggle"><i class="fa-solid fa-eye password-toggle"></i></span>
                    </div>

                    <a href="#" class="forgot-password-link">Mot de passe oublié ?</a>

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

            <!-- Creer compte -->
            <div id="registerView" class="auth-view">
                <h3 style="font-size: 16px; margin-bottom: 20px;">Créer mon Compte</h3>

                <form action="{{ route('register') }}" method="POST" id="registerForm">
                    @csrf
                    <label for="register-lastname">Nom (ou Prénoms)*</label>
                    <input type="text" name="name" required placeholder="Votre nom">

                    <label>Contact</label>
                    <input type="tel" name="phone" required placeholder="Contact">

                    <label for="register-email">E-mail*</label>
                    <input type="email" name="email" required placeholder="example@email.com">

                    <label for="register-password">Mot de passe*</label>
                    <div class="password-field">
                        <input type="password" name="password" required>
                        <span class="password-toggle"><i class="fa-solid fa-eye password-toggle"></i></span>
                    </div>

                    <label for="register-password-confirm">Retaper Mot de passe*</label>
                    <div class="password-field">
                        <input type="password" name="password_confirmation" required>
                        <span class="password-toggle"><i class="fa-solid fa-eye password-toggle"></i></span>
                    </div>

                    <button type="submit" class="auth-btn">S'inscrire</button>
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

    <!-- Modale Reset Password -->
    <aside class="contact-sidebar login-sidebar" id="resetPasswordSidebar">
        <header class="contact-header">
            <h2 class="contact-title">Réinitialiser le mot de passe</h2>
            <button id="closeResetSidebar" class="close-btn" aria-label="Fermer le panneau de réinitialisation">
                &times;
            </button>
        </header>
        <div class="contact-body">
            <p style="margin-bottom: 20px;">
                Entrez votre adresse email pour recevoir un lien de réinitialisation du mot de passe.
            </p>
            <form action="{{ route('password.email') }}" method="POST" id="resetPasswordForm">
                @csrf
                <label for="reset-email">E-mail*</label>
                <input type="email" name="email" required placeholder="example@email.com">

                <button type="submit" class="auth-btn">Envoyer le lien</button>
            </form>

            <hr class="separator">
            <button class="secondary-btn switch-to-login">
                Retour à la connexion
            </button>
        </div>
    </aside>

    <!-- Modale confirmation -->
    <aside class="contact-sidebar login-sidebar" id="newPasswordSidebar">
        <header class="contact-header">
            <h2 class="contact-title">Créer un nouveau mot de passe</h2>
            <button id="closeNewPasswordSidebar" class="close-btn" aria-label="Fermer la modale nouveau mot de passe">
                &times;
            </button>
        </header>
        <div class="contact-body">
            <p style="margin-bottom: 20px;">
                Saisissez votre nouveau mot de passe et confirmez-le.
            </p>
            <form action="{{ route('password.update') }}" method="POST" id="newPasswordForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token ?? '' }}">

                <label for="new-password">Nouveau mot de passe*</label>
                <div class="password-field">
                    <input type="password" name="password" required>
                    <span class="password-toggle">...</span>
                </div>

                <label for="new-password-confirm">Confirmer le mot de passe*</label>
                <div class="password-field">
                    <input type="password" name="password_confirmation" required>
                    <span class="password-toggle">...</span>
                </div>

                <button type="submit" class="auth-btn">Modifier le mot de passe</button>
            </form>

        </div>
    </aside>