@extends('admin.AdminDashboard')

@section('content')
<div class="card p-4">
    <h5>Ajouter un client</h5>

    <form method="POST" action="{{ route('admin.customers.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nom</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" type="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Téléphone</label>
            <input name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Confirmer mot de passe</label>
            <input name="password_confirmation" type="password" class="form-control" required>
        </div>

        <button class="btn bg-gradient-dark">Enregistrer</button>
    </form>
</div>
@endsection