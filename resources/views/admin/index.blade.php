@extends('admin.AdminDashboard')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Administrateurs</h5>
        <a href="{{ route('admin.admins.create') }}"
            class="btn btn-sm bg-gradient-dark">
            + Nouvel admin
        </a>
    </div>

    <div class="card-body">
        <table class="table align-items-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>
                        <span class="badge bg-{{ $admin->is_active ? 'success' : 'danger' }}">
                            {{ $admin->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.admins.edit', $admin) }}"
                            class="btn btn-sm btn-outline-primary">Edit</a>

                        <form action="{{ route('admin.admins.toggle', $admin) }}"
                            method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-outline-warning">
                                {{ $admin->is_active ? 'Désactiver' : 'Activer' }}
                            </button>
                        </form>

                        <form action="{{ route('admin.admins.reset-password', $admin) }}"
                            method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-info">
                                Reset MDP
                            </button>
                        </form>

                        <form action="{{ route('admin.admins.destroy', $admin) }}"
                            method="POST" class="d-inline"
                            onsubmit="return confirm('Supprimer cet admin ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $admins->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection