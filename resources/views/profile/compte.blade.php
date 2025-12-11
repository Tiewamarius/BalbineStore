@extends('layouts.myapp')

@section('title', 'Mon profil — Balbine Store')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/compte.css') }}">
@endpush

<!-- MENU SECONDAIRE -->
<nav class="sub-menu" id="subMenu">
    <a href="#" data-tab="overview" class="active">Aperçu</a>
    <a href="#" data-tab="profil">Mon profil</a>
    <a href="#" data-tab="achats">Mes achats</a>
    <a href="#" data-tab="rendezvous">Mes Livrais</a>
    <a href="#" data-tab="wishlist">Ma wishlist</a>
</nav>

<!-- CONTENU PRINCIPAL -->
<main class="compte-content">

    <!-- Aperçu -->
    <section class="tab-content active" data-tab="overview">
        <div class="overview-header">
            <h2>{{ Auth::user()->name }}</h2>
            <p class="overview-subtitle">Identifiant : {{ Auth::user()->email }}</p>
        </div>

        <div class="overview-grid">
            <div class="overview-card">
                <h3>Mon profil</h3>
                <p>Gérez vos informations personnelles.</p>
                <a href="#" class="btn" data-tab="profil">Voir mon profil</a>
            </div>

            <div class="overview-card">
                <h3>Mes achats</h3>

                @if($orders->count() > 0)
                <p>{{ $orders->count() }} commande(s) passée(s).</p>
                <a href="#" data-tab="achats" class="btn">Voir mes achats</a>
                @else
                @if($orders->count() == 0)
                <p>Vous n'avez pas encore de commande.</p>
                @else
                @foreach($orders as $order)
                <div class="order-item">
                    <div class="order-info">
                        <h4>Commande #{{ $order->reference }}</h4>
                        <p>Montant : {{ number_format($order->total, 0, ',', ' ') }} FCFA</p>
                        <p>Statut : {{ ucfirst($order->status) }}</p>
                        <p>Date : {{ $order->created_at->format('d/m/Y') }}</p>
                    </div>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn">Détails</a>
                </div>
                @endforeach
                @endif

                <a href="{{ url('/') }}" class="btn">Commencer mes achats</a>
                @endif
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

            <!-- <div class="overview-card">
                <h3>Mes certificats</h3>
                <p>Vous n'avez pas encore ajouté de certificat.</p>
                <a href="#" class="btn">Ajouter un certificat</a>
            </div> -->
        </div>
    </section>

    <!-- Mon profil -->
    <section class="tab-content" data-tab="profil">
        <div class="profil-container">
            <h1 class="profil-title">Mon profil</h1>

            <div class="profil-grid">

                <!-- Informations personnelles -->
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
                        <input type="text" name="country" value="{{ old('country', Auth::user()->country ?? "Côte d'Ivoire") }}" required>

                        <button type="button" class="btn-secondary">
                            + Ajoutez votre adresse de livraison
                        </button>

                        <div class="checkbox-group">
                            <label><input type="checkbox"> Actualité par courrier</label>
                            <label><input type="checkbox"> Informations par téléphone</label>
                            <label><input type="checkbox"> Informations par SMS</label>
                        </div>

                        <label>Date de naissance</label>
                        <div class="birth-date">
                            <select name="day">@for($i=1;$i<=31;$i++) <option>{{ $i }}</option>@endfor</select>
                            <select name="month">@for($i=1;$i<=12;$i++) <option>{{ $i }}</option>@endfor</select>
                            <select name="year">@for($i=1940;$i<=date('Y');$i++) <option>{{ $i }}</option>@endfor</select>
                        </div>

                        <button type="submit" class="btn-primary">Enregistrer</button>
                    </form>
                </section>

                <!-- Sidebar -->
                <aside class="profil-sidebar">
                    <div class="profil-block">
                        <h2>Mes préférences</h2>
                        <div class="toggle-group">
                            <label>Email <input type="checkbox"></label>
                            <label>Téléphone <input type="checkbox"></label>
                            <label>SMS <input type="checkbox"></label>
                            <!-- <label>Poste <input type="checkbox"></label>
                            <label>Publicité partenaire <input type="checkbox"></label> -->
                        </div>
                    </div>

                    <div class="profil-block">
                        <h2>Identifiant</h2>
                        <p><strong>E-mail</strong><br>{{ Auth::user()->email }}</p>
                        <button class="btn-primary">Changer votre mot de passe</button>
                    </div>

                    <div class="profil-block">
                        <h2>Adresses</h2>
                        <p>Aucune adresse enregistrée.</p>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    <!-- Achats -->
    <section class="tab-content" data-tab="achats">
        <div class="card">
            <div class="card-header">Mes achats</div>
            <div class="card-body">

                @if($orders->isEmpty())
                <p>Vous n'avez pas encore de commande.</p>
                <a href="{{ url('/') }}" class="btn btn-primary mt-2">Commencer mes achats</a>
                @else
                <div class="orders-list">
                    @foreach($orders as $order)
                    @foreach($order->items as $item)
                    <div class="order-item d-flex align-items-center justify-content-between mb-3 p-2 border rounded">

                        <!-- Image produit -->
                        <div class="order-img me-3">
                            <img src="{{ $item->product->images->first()?->url ?? asset('images/default-product.png') }}"
                                alt="{{ $item->product->name }}" width="80" height="80">
                        </div>

                        <!-- Infos produit -->
                        <div class="order-info flex-grow-1">
                            <h5 class="mb-1">{{ $item->product->name }}</h5>
                            @if($item->variant)
                            <p class="mb-1">Size: {{ $item->variant->size ?? '' }}</p>
                            @endif
                            <p class="mb-1">
                                Statut :
                                <span class="badge 
                                        @if($order->status == 'livré') bg-success
                                        @elseif($order->status == 'pending') bg-warning
                                        @elseif($order->status == 'annulé') bg-danger
                                        @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                            <p class="mb-0">Date : {{ $order->created_at->format('d-m-Y') }}</p>
                        </div>

                        <!-- Bouton détails -->
                        <div class="order-actions ms-3">
                            <a href="{{ route('orders.show', $order->id) }}" class="text-orange fw-bold">
                                Détails
                            </a>
                        </div>

                    </div>
                    @endforeach
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </section>


    <!-- Rendez-vous -->
    <section class="tab-content" data-tab="rendezvous">
        <div class="card">
            <div class="card-header">Mes rendez-vous</div>
            <div class="card-body">
                <p>Aucun rendez-vous planifié.</p>
            </div>
        </div>
    </section>

    <!-- Wishlist -->
    <section class="tab-content" data-tab="wishlist">
        <div class="card">
            <div class="card-header">Ma wishlist</div>
            <div class="card-body">
                <p>Aucune wishlist pour le moment.</p>
            </div>
        </div>
    </section>

</main>

<footer>
    <p><a href="#">Conditions générales de vente</a></p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Me déconnecter</button>
    </form>
</footer>