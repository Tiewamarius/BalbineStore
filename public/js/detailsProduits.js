document.addEventListener('DOMContentLoaded', () => {
    // --- État et Sélecteurs ---
    const isUserAuthenticated = false; 
    const header = document.querySelector('.hero-header');
    const scrollThreshold = 100;

    const menuToggle = document.getElementById('menuToggle');
    const loginToggle = document.getElementById('loginToggle'); 
    const contactAdvisorLink = document.getElementById('contactAdvisorLink');
    const contactLinkDesktop = document.getElementById('contactLinkDesktop');

    const mobileMenu = document.getElementById('mobileMenu');
    const contactSidebar = document.getElementById('contactSidebar');
    const loginSidebar = document.getElementById('loginSidebar');
    
    const closeMenu = document.getElementById('closeMenu');
    const closeContactSidebar = document.getElementById('closeContactSidebar');
    const closeLoginSidebar = document.getElementById('closeLoginSidebar');
    const overlay = document.getElementById('overlay');
    const body = document.body;
    
    // Vues Connexion/Inscription
    const loginView = document.getElementById('loginView');
    const registerView = document.getElementById('registerView');
    const switchToRegisterBtn = loginSidebar ? loginSidebar.querySelector('.switch-to-register') : null;
    const switchToLoginBtn = loginSidebar ? loginSidebar.querySelector('.switch-to-login') : null;
    const loginSidebarTitle = document.getElementById('loginSidebarTitle');
    const passwordToggles = loginSidebar ? loginSidebar.querySelectorAll('.password-toggle') : [];

    // --- Fonctions Modales (Ouverture/Fermeture) ---

    function openModal(modalToOpen) {
        mobileMenu.classList.remove('active');
        contactSidebar.classList.remove('active');
        loginSidebar.classList.remove('active');

        modalToOpen.classList.add('active');
        overlay.classList.add('active');
        body.classList.add('modal-open');
    }

    function closeAllModals() {
        mobileMenu.classList.remove('active');
        contactSidebar.classList.remove('active');
        loginSidebar.classList.remove('active');
        overlay.classList.remove('active');
        body.classList.remove('modal-open');
    }

    // --- Événements d'ouverture ---
    if (menuToggle) menuToggle.addEventListener('click', () => openModal(mobileMenu));
    
    if (loginToggle) {
        loginToggle.addEventListener('click', () => {
            if (!isUserAuthenticated) {
                // S'assurer que la vue de connexion est la première affichée
                switchAuthView('login'); 
                openModal(loginSidebar);
            } else {
                // Logique pour utilisateur connecté (ex: rediriger vers profil)
                console.log('Utilisateur connecté. Afficher le profil.');
            }
        });
    }

    [contactLinkDesktop, contactAdvisorLink].forEach(link => {
        if (link) link.addEventListener('click', (e) => {
            e.preventDefault(); 
            openModal(contactSidebar);
        });
    });

    // --- Événements de fermeture ---
    if (closeMenu) closeMenu.addEventListener('click', closeAllModals);
    if (closeContactSidebar) closeContactSidebar.addEventListener('click', closeAllModals);
    if (closeLoginSidebar) closeLoginSidebar.addEventListener('click', closeAllModals);
    if (overlay) overlay.addEventListener('click', closeAllModals);
    
    
    // --- LOGIQUE LOGIN/REGISTER (Bascule des vues) ---
    function switchAuthView(view) {
        if (!loginView || !registerView || !loginSidebarTitle) return;

        loginView.classList.remove('active');
        registerView.classList.remove('active');

        if (view === 'register') {
            registerView.classList.add('active');
            loginSidebarTitle.textContent = "Création de compte";
        } else {
            loginView.classList.add('active');
            loginSidebarTitle.textContent = "Votre Adresse Email";
        }
    }

    if (switchToRegisterBtn) switchToRegisterBtn.addEventListener('click', () => switchAuthView('register'));
    if (switchToLoginBtn) switchToLoginBtn.addEventListener('click', () => switchAuthView('login'));

    // --- LOGIQUE AFFICHER/MASQUER MOT DE PASSE ---
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const passwordInput = toggle.closest('.password-field').querySelector('input[type="password"], input[type="text"]');
            
            if (passwordInput) {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Optionnel: Mettre à jour l'icône/le style si l'icône SVG change
            }
        });
    });

    // --- LOGIQUE SCROLL DU HEADER (Fixed Header) ---
    function checkScroll() {
        if (window.scrollY > scrollThreshold) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', checkScroll);
    checkScroll();
});