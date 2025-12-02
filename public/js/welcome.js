document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const overlay = document.getElementById('overlay');

    // --- MODALES ---
    const modals = {
        mobileMenu: document.getElementById('mobileMenu'),
        contactSidebar: document.getElementById('contactSidebar'),
        loginSidebar: document.getElementById('loginSidebar'),
        resetPasswordSidebar: document.getElementById('resetPasswordSidebar'),
        newPasswordSidebar: document.getElementById('newPasswordSidebar'),
        wishlistSidebar: document.getElementById('wishlistSidebar'),
        cartSidebar: document.getElementById('cartSidebar')
    };

    // --- FOCUS TRAP ---
    function trapFocus(modal) {
        if (!modal) return;
        const focusables = modal.querySelectorAll('a, button, input, textarea, [tabindex]:not([tabindex="-1"])');
        const first = focusables[0], last = focusables[focusables.length - 1];
        modal.addEventListener('keydown', e => {
            if (e.key !== 'Tab') return;
            if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
            else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
        });
    }

    // --- OPEN / CLOSE MODALS ---
    function closeAllModals() {
        Object.values(modals).forEach(m => m?.classList.remove('active'));
        overlay?.classList.remove('active');
        body.classList.remove('modal-open');
    }

    function openModal(modal) {
        if (!modal) return;
        closeAllModals();
        modal.classList.add('active');
        overlay?.classList.add('active');
        body.classList.add('modal-open');
        trapFocus(modal);
    }

    // --- CLICK EVENTS ---
    document.addEventListener('click', e => {
        const btn = e.target.closest('button, a, span');
        if (!btn) return;

        // --- OPEN MODALS ---
        if (btn.id === 'menuToggle') { e.preventDefault(); openModal(modals.mobileMenu); }
        else if (btn.id === 'loginToggle') openModal(modals.loginSidebar);
        else if (btn.id === 'wishlistToggle') openModal(modals.wishlistSidebar);
        else if (btn.id === 'cartToggle') openModal(modals.cartSidebar);
        else if (btn.id === 'contactLinkDesktop') { e.preventDefault(); openModal(modals.contactSidebar); }

        // --- CLOSE MODALS ---
        else if ([
            'closeMenu','closeContactSidebar','closeLoginSidebar','closeResetSidebar','closeNewPasswordSidebar','closeWishlistSidebar','closeCartSidebar'
        ].includes(btn.id) || e.target === overlay) closeAllModals();

        // --- SWITCH LOGIN / REGISTER / RESET ---
        else if (btn.classList.contains('switch-to-register')) {
            modals.loginSidebar.querySelector('#loginView').classList.remove('active');
            modals.loginSidebar.querySelector('#registerView').classList.add('active');
            modals.loginSidebar.querySelector('#loginSidebarTitle').textContent = "Création de compte";
        }
        else if (btn.classList.contains('switch-to-login')) {
            modals.loginSidebar.querySelector('#registerView').classList.remove('active');
            modals.loginSidebar.querySelector('#loginView').classList.add('active');
            modals.loginSidebar.querySelector('#loginSidebarTitle').textContent = "Votre Adresse Email";
        }
        else if (btn.classList.contains('forgot-password-link')) {
            e.preventDefault();
            openModal(modals.resetPasswordSidebar);
        }

        // --- TOGGLE PASSWORD VISIBILITY ---
        else if (btn.classList.contains('password-toggle')) {
            const input = btn.closest('.password-field')?.querySelector('input');
            if (!input) return;
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    });

    // --- AJAX AUTH FORMS ---
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function handleAuthForm(form, successCallback) {
        if (!form) return;
        form.addEventListener('submit', async e => {
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            btn.disabled = true; btn.innerText = 'Veuillez patienter...';

            try {
                const formData = new FormData(form);
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Accept':'application/json' },
                    body: formData
                });
                const data = await res.json();
                if (res.ok) successCallback?.(data);
                else if (data.errors) {
                    Object.keys(data.errors).forEach(key => {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input) {
                            let div = input.nextElementSibling;
                            if(!div || !div.classList.contains('input-error')) {
                                div = document.createElement('div');
                                div.classList.add('input-error');
                                input.after(div);
                            }
                            div.style.display='block'; div.innerText = data.errors[key][0];
                        }
                    });
                } else if (data.message) alert(data.message);
            } catch(err) { console.error(err); alert('Erreur réseau, réessayez.'); }
            finally { btn.disabled = false; btn.innerText = form.dataset.submitText || 'Envoyer'; }
        });
    }

    handleAuthForm(document.getElementById('loginForm'), data => location.reload());
    handleAuthForm(document.getElementById('registerForm'), data => location.reload());
    handleAuthForm(document.getElementById('resetPasswordForm'), data => {
        alert('Lien de réinitialisation envoyé !');
        document.getElementById('resetPasswordForm').reset();
        closeAllModals();
        openModal(modals.loginSidebar);
    });
    handleAuthForm(document.getElementById('newPasswordForm'), data => {
        alert('Mot de passe modifié !');
        closeAllModals();
    });
});

