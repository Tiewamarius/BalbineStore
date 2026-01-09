@extends('admin.AdminDashboard')

@section('content')
<div class="card p-4">
    <h5>Modifier client</h5>

    <form method="POST" action="{{ route('admin.customers.update', $user) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nom</label>
            <input name="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" value="{{ $user->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Téléphone</label>
            <input name="phone" value="{{ $user->phone }}" class="form-control">
        </div>

        <button class="btn bg-gradient-dark">Mettre à jour</button>
    </form>
</div>
@endsection