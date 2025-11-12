@extends('adminauth.AdminDashboard')

@section('title', 'Synchronisation iCal')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>📅 Suivi des synchronisations iCal</h4>
        <a href="{{ route('admin.ical.syncAll') }}" class="btn btn-primary">
            🔄 Forcer la synchronisation manuelle
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Résidence</th>
                        <th>Plateforme</th>
                        <th>URL iCal</th>
                        <th>Dernière synchro</th>
                        <th>Statut</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($icalLinks as $link)
                    <tr>
                        <td>{{ $link->residence->nom ?? 'N/A' }}</td>
                        <td><span class="badge bg-info">{{ strtoupper($link->platform) }}</span></td>
                        <td title="{{ $link->url }}">
                            {{ Str::limit($link->url, 60) }}
                        </td>
                        <td>
                            @if($link->last_synced_at)
                            {{ \Carbon\Carbon::parse($link->last_synced_at)->diffForHumans() }}
                            @else
                            <span class="text-muted">Jamais</span>
                            @endif
                        </td>
                        <td>
                            @if(!$link->last_synced_at)
                            <span class="badge bg-secondary">Jamais synchronisé</span>
                            @elseif($link->last_synced_at->lt(now()->subHours(6)))
                            <span class="badge bg-warning text-dark">Ancien</span>
                            @else
                            <span class="badge bg-success">À jour</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.ical.syncOne', $link->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    🔁 Synchroniser
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucun flux iCal configuré.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection