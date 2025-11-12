<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BALBINE STORE</title>
    <link rel="icon" type="image/png" href="{{ asset('images/cropped-logo-odedis-store-32x32.Jpg') }}">
    <meta name="description" content="Balbine Store — Produits d'entretien professionnels et grand public. Découvrez notre sélection.">
    <meta property="og:title" content="Balbine Store">
    <meta property="og:description" content="Produits d'entretien et matériel professionnel.">
    <meta property="og:image" content="{{ asset('images/BALBINE-STORE-1--1536x768.jpg') }}">
    <meta name="robots" content="index,follow">

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <script src="{{ asset('js/welcome.js') }}" defer></script>

</head>

<body>
    <section class="hero-banner">
        <img src="{{ asset('images/2021-12-produits-menagers-1536x959.jpg') }}" alt="Balbine Store Banner" class="hero-bg">

        <div class="hero-overlay">
            <header class="hero-header">
                <div class="hero-left">
                    <button class="menu-btn" id="menuToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                        </svg>
                    </button>

                    <a class="menu-btn" href=" {{ url('/search') }}">
                        <span class="search-text">Que recherchez-vous ?</span>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                        </svg>
                    </a>

                </div>
                <a href="{{ url('/') }}">
                    <div class="hero-center">
                        <h1 class="logo">BALBINE STORE</h1>
                    </div>
                </a>
                <div class="hero-right">
                    <a href="#" id="contactLinkDesktop">Contactez-nous</a>

                    <span class="icon" id="wishlistToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Zm0-108q96-86 158-147.5t98-107q36-45.5 50-81t14-70.5q0-60-40-100t-100-40q-47 0-87 26.5T518-680h-76q-15-41-55-67.5T300-774q-60 0-100 40t-40 100q0 35 14 70.5t50 81q36 45.5 98 107T480-228Zm0-273Z" />
                        </svg>
                    </span>
                    @guest
                    <span class="icon" id="loginToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path
                                d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                        </svg>
                    </span>
                    @else
                    <a class="menu-btn" href=" {{ url('/compte') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path
                                d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                        </svg>
                        <span class="search-text">Bienvenue {{ Auth::user()->name }}</span>

                    </a>
                    @endguest

                    <span class="icon" id="cartToggle">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#e3e3e3">
                            <path
                                d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                        </svg>
                        {{-- Affichage du badge du panier uniquement si l'utilisateur est connecté et a des articles --}}
                        @auth
                        {{-- la logique ci-dessous par votre méthode réelle pour obtenir le compte --}}
                        @php

                        @endphp
                        <span id="cartCount" class="cart-badge">{{ count(session('cart', []))}}</span>
                        @endauth
                    </span>
                </div>
            </header>
            <div class="hero-content">

                <a href="#" class="hero-btn">
                    Découvrez nos produits
                </a>
            </div>
        </div>
    </section>
    <section class="product-selection-section">
        <h2 class="section-title">Explorez les produits d'entretient de vos espaces</h2>

        <div class="product-grid">
            <div class="product-card">
                <div class="card-image-container">
                    <img src="{{ asset('images/repulsif_serpents_concentre.jpg') }}" alt="Collection Monogram Personnalisation" class="product-image">
                </div>
                <p class="product-label">Multi-surfaces</p>
            </div>
            <div class="product-card">
                <div class="card-image-container">
                    <img src="{{ asset('images/Solipropre-ultra-degraissant-Ecolabel-750ml-bleu-500x668.jpg') }}" alt="Sacs Femme Louis Vuitton" class="product-image">
                </div>
                <p class="product-label">Javel liquide</p>
            </div>
            <div class="product-card">
                <div class="card-image-container">
                    <img src="{{ asset('images/gants-600x574.png') }}" alt="Bijoux Fantaisie Femme" class="product-image">
                </div>
                <p class="product-label">Gants</p>
            </div>
            <div class="product-card">
                <div class="card-image-container">
                    <img src="{{ asset('images/Pulverisateurs.jpg') }}" alt="Produits de La Beauté Louis Vuitton" class="product-image">
                </div>
                <p class="product-label">Pulverisateurs</p>
            </div>
        </div>
    </section>
    <section class="pubmarketing-section">
        <img src="{{ asset('images/BALBINE-STORE-1--1536x768.jpg') }}" alt="Promotion spéciale" class="pub-image">
    </section>
    <div class="product-grid">

        <a href="{{ url('detailsProduct') }}">
            <div class="product-card">
                <div class="product-image-wrapper">
                    <img src="images/desinfectant-virucide-500x667.jpg" alt="Sac Side Trunk MM">
                    <span class="custom-badge">Personnalisable</span>
                </div>
                <div class="product-info">
                    <p class="product-name">Sac Side Trunk MM</p>
                    <p class="product-price">3 200,00 XOF</p>
                </div>
                <button class="wishlist-btn" aria-label="Ajouter aux favoris">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000">
                        <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                    </svg>
                </button>
            </div>
        </a>
        <a href="http://">
            <div class="product-card">
                <div class="product-image-wrapper">
                    <img src="images/desinfectant-virucide-500x667.jpg" alt="Sac Side Trunk MM">
                    <span class="custom-badge">Personnalisable</span>
                </div>
                <div class="product-info">
                    <p class="product-name">Sac Side Trunk MM</p>
                    <p class="product-price">3 200,00 XOF</p>
                </div>
                <button class="wishlist-btn" aria-label="Ajouter aux favoris">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960" width="20px" fill="#000000">
                        <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                    </svg>
                </button>
            </div>
        </a>


    </div>
    <div class="overlay" id="overlay"></div>

    <!-- Menu-Mobile -->
    <nav class="mobile-menu" id="mobileMenu">
        <header>
            <span>CATEGORIES</span>
            <button id="closeMenu">✕</button>
        </header>
        <ul>
            <li><a href="#">Produits d'entretien</a></li>
            <li><a href="#">Produits professionnels</a></li>
            <li><a href="#">Matériel</a></li>
            <li><a href="#">Machines</a></li>
            <li><a href="#">Hygiène & sanitaires</a></li>
            <li><a href="#">Écologiques</a></li>
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
                    <a href="tel:+33977404077">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#000000">
                            <path
                                d="m720-560-58-56 64-64H520v-80h206l-62-62 56-58 160 162-160 158Zm78 440q-125 0-247-54.5T329-329Q229-429 174.5-551T120-798q0-18 12-30t30-12h162q14 0 25 9.5t13 22.5l26 140q2 16-1 27t-11 19l-97 98q20 37 47.5 71.5T387-386q31 31 65 57.5t72 48.5l94-94q9-9 23.5-13.5T670-390l138 28q14 4 23 14.5t9 23.5v162q0 18-12 30t-30 12ZM241-600l66-66-17-94h-89q5 41 14 81t26 79Zm358 358q39 17 79.5 27t81.5 13v-88l-94-19-67 67ZM241-600Zm358 358Z" />
                        </svg>
                        <span>+33 9 77 40 40 77</span>
                    </a>
                </li>

                <li>
                    <a href="mailto:contact@balbine.store">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#000000">
                            <path
                                d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v320h640v-320L480-440Zm0-80 320-200H160l320 200ZM160-640v-80v80Z" />
                        </svg>
                        <span>Envoyer un e-mail</span>
                    </a>
                </li>
                <li>
                    <a href="https://wa.me/0143633011" target="_blank">
                        <img src="{{ asset('whatsapp-icon.png') }}" alt="WhatsApp Icon" style="width: 24px; height: 24px;">
                        <span>WhatsApp</span>
                    </a>
                </li>
                <li>
                    <a href="https://m.me/votre_page_facebook" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#000000">
                            <path
                                d="M480-80q-137 0-255-63.5T40-348q-18-56-25.5-104T10-539v-136q0-100 70-170t170-70h478q100 0 170 70t70 170v200q0 100-70 170t-170 70H327L148-80h332ZM190-760q-48 0-82 34t-34 82v120q0 100 50 162.5T365-275l41 41 43 40v-195q0-50 35-85t85-35h172q48 0 82-34t34-82v-120q0-48-34-82t-82-34H244q-48 0-54 12v-12Zm0 0v-12h760q48 0 82 34t34 82v120q0 48-34 82t-82 34H244q-48 0-82 34t-34 82v146l-44 44q-11 11-23 16.5t-24 5.5q-16 0-30-8t-24-22q-10-14-15-32t-5-38v-136q0-100 70-170t170-70h478q48 0 82-34t34-82v-120q0-48-34-82t-82-34H244q-48 0-82 34t-34 82Z" />
                        </svg>
                        <span>Facebook Messenger</span>
                    </a>
                </li>
                <!-- <li class="disabled-option">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#000000">
                            <path
                                d="M510-160q32 0 61-12t53-35l14-16q12-14 18-35.5t6-46.5v-180q0-33 23.5-56.5T840-570q33 0 56.5 23.5T920-490v200q0 31-7 55t-25 45l-14 16q-19 22-54 41t-77 24q-22 5-47 5h-24v80h-80v-80q-40-10-74-29.5T380-160h130Zm-40-80q-50 0-86-35.5T340-360q0-50 36-86t86-36q50 0 86 36t36 86q0 50-36 85.5T470-240Zm0-80q17 0 28.5-11.5T510-360q0-17-11.5-28.5T470-400q-17 0-28.5 11.5T430-360q0 17 11.5 28.5T470-320ZM120-120v-80h200v80H120Zm-40-80v-80h400v80H80Zm140-120q-33 0-56.5-23.5T120-440v-200q0-33 23.5-56.5T200-720h560q33 0 56.5 23.5T840-640v120h-80v-80H200v200h150q40 0 84 10.5t82 32.5q-15 48-38 88.5T452-240h-82v40h-40v40h-40Z" />
                        </svg>
                        <span>Service Clients Sourds et Malentendants</span>
                    </a>
                    <p class="disabled-message">Bientôt disponible</p>
                </li> -->
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

    <!-- Modale Wishlist -->

    <aside class="contact-sidebar login-sidebar" id="wishlistSidebar">
        <header class="contact-header">
            <h2 class="contact-title">Ma Liste de Souhaits</h2>
            <button id="closeWishlistSidebar" class="close-btn" aria-label="Fermer la wishlist">
                &times;
            </button>
        </header>
        <div class="contact-body">
            <div class="not-logged">
                <p>Connectez-vous pour voir votre liste de souhaits.</p>
                <button class="auth-btn" data-modal="login">Se connecter</button>
            </div>
        </div>
    </aside>


    <!-- Modale Panier -->
    <aside id="cartSidebar" class="contact-sidebar">
        <header class="contact-header">
            <h2>Mon Panier</h2>
            <button id="closeCartSidebar" class="close-btn">&times;</button>
        </header>

        <div class="contact-content">
            @php $cart = session('cart', []); @endphp
            @if(count($cart) > 0)
            <ul class="cart-items">
                @foreach($cart as $id => $item)
                <li>
                    <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}">
                    <div>
                        <h4>{{ $item['name'] }}</h4>
                        <p>{{ $item['price'] }} FCFA × {{ $item['quantity'] }}</p>
                    </div>
                    <button class="remove-item" data-id="{{ $id }}">✖</button>
                </li>
                @endforeach
            </ul>
            <div class="cart-footer">
                <button id="clearCart" class="btn-clear">Vider le panier</button>
                <a href="{{ route('checkout') }}" class="btn-checkout">Passer à la caisse</a>
            </div>
            @else
            <p>Votre panier est vide.</p>
            @endif
        </div>
    </aside>

</body>

</html>