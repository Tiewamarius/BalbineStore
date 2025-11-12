@extends('layouts.myapp')

@section('title', 'Mon profil — Balbine Store')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/compte.css') }}">
@endpush


@section('content')
<!-- BANNIÈRE -->
<section class="banner">
    <img src="{{ asset('images/2021-12-produits-menagers-1536x959.jpg') }}" alt="Bannière">
    <div class="user-badge">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
</section>

<!-- MENU SECONDAIRE -->
<nav class="sub-menu" id="subMenu">
    <a href="#" data-tab="overview">Aperçu</a>
    <a href="#" data-tab="profil" class="active">Mon profil</a>
    <a href="#" data-tab="achats">Mes achats</a>
    <a href="#" data-tab="rendezvous">Mes Livrais</a>
    <a href="#" data-tab="wishlist">Ma wishlist</a>
    <!-- <a href="#" data-tab="certificats">Mes certificats</a> -->
</nav>


<!-- CONTENU PRINCIPAL -->
<!-- CONTENU PRINCIPAL -->
<main class="compte-content">
    <!-- Onglet : Aperçu -->
    <section class="tab-content active" data-tab="overview">
        <div class="overview-header">
            <h2>{{ Auth::user()->name }}</h2>
            <p class="overview-subtitle">Identifiant : {{ Auth::user()->email }}</p>
        </div>

        <div class="overview-grid">
            <div class="overview-card">
                <h3>Mon profil</h3>
                <p>Gérez vos informations personnelles.</p>
                <a href="#" class="btn">Voir mon profil</a>
            </div>

            <div class="overview-card">
                <h3>Mes achats</h3>
                <p>Pas encore de commande en cours.</p>
                <a href="{{ url('/') }}" class="btn">Commencer mes achats</a>
            </div>

            <div class="overview-card">
                <h3>Mes rendez-vous</h3>
                <p>Pas encore de rendez-vous planifié.</p>
                <a href="#" class="btn">Prendre rendez-vous</a>
            </div>

            <div class="overview-card">
                <h3>Ma wishlist</h3>
                <p>Créez et partagez votre wishlist Balbine Store.</p>
                <a href="#" class="btn">Voir ma wishlist</a>
            </div>

            <div class="overview-card">
                <h3>Mes certificats</h3>
                <p>Vous n'avez pas encore ajouté de certificat.</p>
                <a href="#" class="btn">Ajouter un certificat</a>
            </div>
        </div>
    </section>

    <!-- Onglet : Mon profil -->
    <div class="tab-content" data-tab="profil">
        <div class="profil-container">
            <!-- Titre -->
            <h1 class="profil-title">Mon profil</h1>

            <div class="profil-grid">
                <!-- 🧍 Informations personnelles -->
                <section class="profil-section">
                    <h2>Informations personnelles</h2>
                    <p class="info-subtitle">Champs obligatoires*</p>

                    <form method="POST" action="{{ route('profile.update') }}" class="profil-form">
                        @csrf
                        @method('PUT')

                        <label>Titre*</label>
                        <select name="title" required>
                            <option value="M">M</option>
                            <option value="Mme">Mme</option>
                            <option value="Mlle">Mlle</option>
                        </select>

                        <label>Prénom*</label>
                        <input type="text" name="firstname" value="{{ old('name', Auth::user()->name) }}" required>

                        <label>Nom*</label>
                        <input type="text" name="lastname" value="{{ old('lastname', Auth::user()->lastname) }}" required>

                        <label>Pays/Région*</label>
                        <input type="text" name="country" value="{{ old('country', Auth::user()->country ?? 'France') }}" required>

                        <button type="button" class="btn-secondary">
                            + Ajoutez votre adresse de livraison
                        </button>

                        <div class="checkbox-group">
                            <label><input type="checkbox"> Je souhaite recevoir l’actualité de la Maison par courrier</label>
                            <label><input type="checkbox"> Je souhaite recevoir des informations exclusives par téléphone</label>
                            <label><input type="checkbox"> Je souhaite recevoir des informations exclusives par SMS</label>
                        </div>

                        <label>Date de naissance</label>
                        <div class="birth-date">
                            <select name="day">@for($i=1;$i<=31;$i++) <option>{{ $i }}</option>@endfor</select>
                            <select name="month">@for($i=1;$i<=12;$i++) <option>{{ $i }}</option>@endfor</select>
                            <select name="year">@for($i=1940;$i<=date('Y');$i++) <option>{{ $i }}</option>@endfor</select>
                        </div>

                        <button type="submit" class="btn-primary">Enregistrer les modifications</button>
                    </form>
                </section>

                <!-- ⚙️ Préférences / Identifiant -->
                <aside class="profil-sidebar">
                    <div class="profil-block">
                        <h2>Mes préférences</h2>
                        <p>
                            Sélectionnez vos canaux de communication pour recevoir les dernières offres et actualités de la Maison.
                        </p>

                        <div class="toggle-group">
                            <label>Email <input type="checkbox" name="pref_email"></label>
                            <label>Téléphone <input type="checkbox" name="pref_tel"></label>
                            <label>Message texte <input type="checkbox" name="pref_sms"></label>
                            <label>Voie postale <input type="checkbox" name="pref_post"></label>
                            <label>Publicité via partenaires tiers <input type="checkbox" name="pref_pub"></label>
                        </div>
                    </div>

                    <div class="profil-block">
                        <h2>Identifiant</h2>
                        <p><strong>E-mail</strong><br>{{ Auth::user()->email }}</p>
                        <button class="btn-primary">Changer votre mot de passe</button>
                    </div>

                    <div class="profil-block">
                        <h2>Mes adresses</h2>
                        <p>Vous n’avez pas encore d’adresse enregistrée.</p>
                    </div>
                </aside>
            </div>
        </div>
    </div>


    <!-- Onglet : Mes achats -->
    <section class="tab-content" data-tab="achats">
        <div class="card">
            <div class="card-header">Mes achats</div>
            <div class="card-body">
                <p>Vous n'avez pas encore de commande en cours.</p>
                <a href="#" class="btn">Commencer mes achats</a>
            </div>
        </div>
    </section>

    <!-- Onglet : Mes rendez-vous -->
    <section class="tab-content" data-tab="rendezvous">
        <div class="card">
            <div class="card-header">Mes rendez-vous</div>
            <div class="card-body">
                <p>Vous n'avez pas encore de rendez-vous planifié.</p>
                <a href="#" class="btn">Prendre rendez-vous</a>
            </div>
        </div>
    </section>

    <!-- Onglet : Ma wishlist -->
    <section class="tab-content" data-tab="wishlist">
        <div class="card">
            <div class="card-header">Ma wishlist</div>
            <div class="card-body">
                <p>Créez et partagez votre wishlist Balbine Store.</p>
                <a href="#" class="btn">Voir ma wishlist</a>
            </div>
        </div>
    </section>

    <!-- Onglet : Mes certificats -->
    <section class="tab-content" data-tab="certificats">
        <div class="card">
            <div class="card-header">Mes certificats</div>
            <div class="card-body">
                <p>Vous n'avez pas encore ajouté de certificat.</p>
                <a href="#" class="btn">Ajouter un certificat</a>
            </div>
        </div>
    </section>

</main>


<!-- FOOTER -->
<footer>
    <p><a href="#">Conditions générales de vente</a></p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Me déconnecter</button>
    </form>
</footer>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.sub-menu a');
        const contents = document.querySelectorAll('.tab-content');

        // Fonction pour activer un onglet
        function activateTab(target) {
            // Retirer tous les états actifs
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));

            // Trouver le lien correspondant
            const activeTab = document.querySelector(`.sub-menu a[data-tab="${target}"]`);
            const activeSection = document.querySelector(`.tab-content[data-tab="${target}"]`);

            if (activeTab) activeTab.classList.add('active');
            if (activeSection) activeSection.classList.add('active');
        }

        // Par défaut, afficher l’aperçu si rien n’est actif
        let defaultTab = 'overview';
        const hash = window.location.hash.replace('#', '');
        const firstActive = hash || defaultTab;

        activateTab(firstActive);

        // Lorsqu’on clique sur un onglet
        tabs.forEach(tab => {
            tab.addEventListener('click', e => {
                e.preventDefault();

                const target = tab.getAttribute('data-tab');
                activateTab(target);

                // Met à jour l’URL sans recharger la page
                history.replaceState(null, '', `#${target}`);
            });
        });

        // Effet de transition douce sur le contenu actif
        contents.forEach(content => {
            content.addEventListener('transitionend', () => {
                content.classList.remove('fade');
            });
        });

        // Petite transition visuelle au changement
        contents.forEach(c => {
            c.classList.add('fade');
        });
    });
</script>
@endpush

@endsection