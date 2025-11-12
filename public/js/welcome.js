document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const overlay = document.getElementById('overlay');

    const modals = {
        mobileMenu: document.getElementById('mobileMenu'),
        contactSidebar: document.getElementById('contactSidebar'),
        loginSidebar: document.getElementById('loginSidebar'),
        resetPasswordSidebar: document.getElementById('resetPasswordSidebar'),
        newPasswordSidebar: document.getElementById('newPasswordSidebar'),
        wishlistSidebar: document.getElementById('wishlistSidebar'),
        cartSidebar: document.getElementById('cartSidebar')
    };

    // Focus trap
    function trapFocus(modal) {
        if (!modal) return;
        const focusables = modal.querySelectorAll('a, button, input, textarea, [tabindex]:not([tabindex="-1"])');
        const first = focusables[0], last = focusables[focusables.length - 1];
        modal.addEventListener('keydown', (e) => {
            if (e.key !== 'Tab') return;
            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault(); last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault(); first.focus();
            }
        });
    }

    function closeAllModals() {
        Object.values(modals).forEach(m => m?.classList.remove('active'));
        overlay.classList.remove('active');
        body.classList.remove('modal-open');
    }

    function openModal(modal) {
        closeAllModals();
        modal.classList.add('active');
        overlay.classList.add('active');
        body.classList.add('modal-open');
        trapFocus(modal);
    }

    // --- Event delegation pour tous les boutons ---
    document.addEventListener('click', (e) => {
        const target = e.target.closest('button, a, span');

        if (!target) return;

        // Triggers principaux
        if (target.matches('#menuToggle')) { e.preventDefault(); openModal(modals.mobileMenu); }
        else if (target.matches('#loginToggle')) openModal(modals.loginSidebar);
        else if (target.matches('#wishlistToggle')) openModal(modals.wishlistSidebar);
        else if (target.matches('#cartToggle')) openModal(modals.cartSidebar);
        else if (target.matches('#contactLinkDesktop') && window.innerWidth >= 769) {
            e.preventDefault(); openModal(modals.contactSidebar);
        }

        // Fermeture
        else if (target.matches('#closeMenu, #closeContactSidebar, #closeLoginSidebar, #closeResetSidebar, #closeNewPasswordSidebar, #closeWishlistSidebar, #closeCartSidebar') || target === overlay) {
            closeAllModals();
        }

        // Switch login/register
        else if (target.matches('.switch-to-register')) {
            modals.loginSidebar.querySelector('#loginView').classList.remove('active');
            modals.loginSidebar.querySelector('#registerView').classList.add('active');
            modals.loginSidebar.querySelector('#loginSidebarTitle').textContent = "Création de compte";
        } else if (target.matches('.switch-to-login')) {
            modals.loginSidebar.querySelector('#registerView').classList.remove('active');
            modals.loginSidebar.querySelector('#loginView').classList.add('active');
            modals.loginSidebar.querySelector('#loginSidebarTitle').textContent = "Votre Adresse Email";
        }

        // Reset password
        else if (target.matches('.forgot-password-link')) {
            e.preventDefault();
            openModal(modals.resetPasswordSidebar);
        }

        // Toggle mot de passe
        else if (target.matches('.password-toggle')) {
            const input = target.closest('.password-field')?.querySelector('input');
            if (!input) return;
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            target.querySelector('svg').style.fill = type === 'text' ? 'black' : '#777';
        }
    });

    // Scroll header
    const header = document.querySelector('.hero-header');
    const scrollThreshold = 100;
    const checkScroll = () => header.classList.toggle('scrolled', window.scrollY > scrollThreshold);
    window.addEventListener('scroll', checkScroll);
    checkScroll();

    // Désactivation bouton submit lors du submit
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', () => {
            const btn = form.querySelector('button[type="submit"]');
            if (btn) { btn.disabled = true; btn.innerText = 'Veuillez patienter...'; }
        });
    });
});
