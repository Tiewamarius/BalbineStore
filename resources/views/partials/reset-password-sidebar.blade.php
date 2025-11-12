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
        <form action="#" method="post" id="resetPasswordForm">
            <label for="reset-email" style="display: block; font-size: 14px; margin-bottom: 5px;">E-mail*</label>
            <input type="email" id="reset-email" name="email" required placeholder="example@email.com">

            <button type="submit" class="auth-btn" style="margin-top: 20px;">
                Envoyer le lien
            </button>
        </form>
        <hr class="separator">
        <button class="secondary-btn switch-to-login">
            Retour à la connexion
        </button>
    </div>
</aside>