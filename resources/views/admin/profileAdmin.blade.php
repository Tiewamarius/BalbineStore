@extends('admin.AdminDashboard')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">

        {{-- ================= PROFIL ================= --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Mon profil administrateur</h5>
            </div>

            <div class="card-body">

                {{-- Success --}}
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Errors --}}
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- UPDATE PROFIL --}}
                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', auth('admin')->user()->name) }}"
                            required>
                    </div>

                    <div class="input-group input-group-outline mb-4">
                        <label class="form-label">Email</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', auth('admin')->user()->email) }}"
                            required>
                    </div>

                    <button type="submit" class="btn bg-gradient-dark">
                        Mettre à jour le profil
                    </button>
                </form>
            </div>
        </div>

        {{-- ================= MOT DE PASSE ================= --}}
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Changer le mot de passe</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.profile.password') }}">
                    @csrf
                    @method('PUT')

                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Mot de passe actuel</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="input-group input-group-outline mb-4">
                        <label class="form-label">Confirmer le nouveau mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-outline-danger">
                        Mettre à jour le mot de passe
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection