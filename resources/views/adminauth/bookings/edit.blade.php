@extends('adminauth.AdminDashboard')
@section('content')
<section class="h-100 h-custom" style="background-color: #d6d1d22c;text-align:center;">
    <div class="container py-2 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-12 mx-auto">
                <div class=" card rounded-3">
                    @php
                    // Récupérer l'image principale ou la première disponible
                    $mainImage = $booking->residence->images
                    ->where('est_principale', true)
                    ->first()
                    ?? $booking->residence->images->first();
                    $mainImageSrc = $mainImage
                    ? asset($mainImage->chemin_image)
                    : 'https://placehold.co/400x300/C0C0C0/333333?text=Image+Appartement';
                    @endphp

                    <div class="position-relative">
                        <img src="{{ $mainImageSrc }}" class="w-100"
                            style="border-top-left-radius: .3rem; border-top-right-radius: .3rem; height: 300px; object-fit: cover;"
                            alt="{{ $booking->residence->nom }}"
                            onerror="this.onerror=null;this.src='https://placehold.co/400x300/C0C0C0/333333?text=Image+Appartement';">

                        <!-- Nom de l'appartement superposé -->
                        <div class="position-absolute bottom-0 start-0 w-100 text-center p-2"
                            style="background: rgba(255, 255, 255, 0.3); backdrop-filter: blur(5px); color: #000; font-weight: bold;">
                            <h2>{{ $booking->residence->nom }}</h2>
                        </div>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <h4 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 text-center">Modifier la réservation</h4>

                        {{-- Messages de succès --}}
                        @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                        @endif

                        {{-- Messages d'erreur --}}
                        @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                        </div>
                        @endif

                        <form class="px-md-2" action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Colonne gauche -->
                                <div class="col-md-6" style="padding:8px; border-radius: 10px; border:0.5px solid #08e037ff;">
                                    <div class="form-outline mb-4 text-center">
                                        <p><strong>ID TRANSACTION :</strong> {{ $booking->payment->id_transaction ?? '---' }}</p>
                                        <p><strong>MONTANT PAYE :</strong> {{ $booking->payment->montant ?? 'Non payé' }}</p>
                                        <p><strong>MODE PAIEMENT:</strong> {{ $booking->payment->methode_paiement ?? '-' }}</p>
                                        <p><strong>STATUT:</strong> {{ $booking->payment->statut ?? '-' }}</p>
                                    </div>

                                    <!-- Boutons -->
                                    <button type="submit" name="action" value="annulé"
                                        class="btn btn-lg mx-2" style="background-color: red; color:white;">
                                        Annulé
                                    </button>
                                    <button type="submit" name="action" value="confirmé"
                                        class="btn btn-lg mx-2" style="background-color: #08e037ff; color:white;">
                                        Validé
                                    </button>
                                    @php
                                    $dateDepart = \Carbon\Carbon::parse($booking->date_depart);
                                    @endphp

                                    @if (now()->lt($dateDepart))
                                    {{-- On ne montre pas le bouton car la réservation est encore en cours --}}
                                    @else
                                    <button type="submit" name="action" value="terminé"
                                        class="btn btn-lg mx-2" style="background-color: #2e24efff; color:white;">
                                        Terminé
                                    </button>
                                    @endif


                                    @if($booking->payment->wave_capture)
                                    <a href="{{ asset($booking->payment->wave_capture) }}" target="_blank"
                                        class="btn btn-lg mx-2" style="background-color: #747b75ff; color:white;">
                                        <i class="fas fa-image"></i>
                                    </a>
                                    @endif
                                </div>

                                <!-- Colonne droite -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label">Date arrivée</label>
                                                <input type="date" name="date_arrivee"
                                                    value="{{ old('date_arrivee', optional($booking->date_arrivee)->format('Y-m-d')) }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label">Date départ</label>
                                                <input type="date" name="date_depart"
                                                    value="{{ old('date_depart', optional($booking->date_depart)->format('Y-m-d')) }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Champ Montant avancé -->
                                    <div class="mb-4">
                                        <div class="form-outline">
                                            <label class="form-label">Montant avancé</label>
                                            <input type="number" name="montant_avance"
                                                value="{{ old('montant_avance', $booking->payment->montant_avance ?? '') }}"
                                                class="form-control" placeholder="Saisir un montant..." />
                                        </div>
                                    </div>

                                    <button type="submit" name="action" value="update"
                                        class="btn btn-lg mx-2 btn-primary">
                                        Mettre à jour
                                    </button>
                                </div>
                            </div>

                            <!-- Ligne des deux derniers boutons (plein écran) -->
                            <div class="d-flex justify-content-center mt-4">
                                <a href="{{ route('admin.bookings.index') }}"
                                    class="btn btn-lg mx-2" style="border: 0.5px solid grey;">
                                    Retour
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection