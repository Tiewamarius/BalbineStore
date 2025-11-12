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
        <form action="#" method="post" id="newPasswordForm">
            <input type="hidden" id="reset-token" name="token" value=""> <!-- Token depuis l’URL -->

            <label for="new-password" style="display: block; font-size: 14px; margin-bottom: 5px;">Nouveau mot de passe*</label>
            <div class="password-field" style="position: relative; margin-bottom: 10px;">
                <input type="password" id="new-password" name="password" required>
                <span class="password-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#777">
                        <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-174 0-337-88.5T40-500q101-137 264-225.5T480-814q174 0 337 88.5T920-500q-101 137-264 225.5T480-192Zm0-320Z" />
                    </svg>
                </span>
            </div>

            <label for="new-password-confirm" style="display: block; font-size: 14px; margin-bottom: 5px; margin-top: 15px;">Confirmer le mot de passe*</label>
            <div class="password-field" style="position: relative; margin-bottom: 20px;">
                <input type="password" id="new-password-confirm" name="password_confirmation" required>
                <span class="password-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#777">
                        <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-174 0-337-88.5T40-500q101-137 264-225.5T480-814q174 0 337 88.5T920-500q-101 137-264 225.5T480-192Zm0-320Z" />
                    </svg>
                </span>
            </div>

            <button type="submit" class="auth-btn">Modifier le mot de passe</button>
        </form>
    </div>
</aside>