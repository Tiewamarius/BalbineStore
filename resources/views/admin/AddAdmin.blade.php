@extends('admin.AdminDashboard')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ajouter un administrateur</h5>
            </div>

            <div class="card-body">
                {{-- Messages --}}
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Erreurs --}}
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.admins.store') }}">
                    @csrf

                    {{-- Nom --}}
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Nom complet</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            required>
                    </div>

                    {{-- Email --}}
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Adresse email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required>
                    </div>

                    {{-- Mot de passe --}}
                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>
                    </div>

                    {{-- Confirmation mot de passe --}}
                    <div class="input-group input-group-outline mb-4">
                        <label class="form-label">Confirmer le mot de passe</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            required>
                    </div>

                    {{-- Boutons --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.admins.index') }}"
                            class="btn btn-outline-secondary">
                            ← Retour
                        </a>

                        <button type="submit" class="btn bg-gradient-dark">
                            Créer l’administrateur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection