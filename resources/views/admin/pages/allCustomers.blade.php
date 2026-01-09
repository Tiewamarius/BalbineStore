@extends('admin.AdminDashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header pb-0 d-flex justify-content-between">
                <h5>Clients</h5>
                <a href="{{ route('admin.customers.create') }}"
                    class="btn bg-gradient-dark btn-sm">
                    + Nouveau client
                </a>
            </div>

            <div class="card-body px-0 pb-0">

                {{-- TOP BAR --}}
                <div class="dataTable-top d-flex justify-content-between px-3">

                    {{-- PER PAGE --}}
                    <form method="GET" action="{{ route('admin.pages.allcustomers') }}">
                        <select name="per_page" class="dataTable-selector"
                            onchange="this.form.submit()">
                            @foreach([5,10,15,20,25] as $size)
                            <option value="{{ $size }}"
                                {{ request('per_page',10)==$size?'selected':'' }}>
                                {{ $size }}
                            </option>
                            @endforeach
                        </select>

                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                    </form>

                    {{-- SEARCH --}}
                    <form method="GET" action="{{ route('admin.pages.allcustomers') }}">
                        <input class="dataTable-input"
                            name="search"
                            placeholder="Nom, email, téléphone"
                            value="{{ request('search') }}">
                        @if(request('per_page'))
                        <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                    </form>
                </div>

                {{-- TABLE --}}
                <table class="table table-flush">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Date</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone ?? '—' }}</td>
                            <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <!-- <a href="{{ route('admin.customers.edit', $customer) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    Modifier
                                </a> -->
                                <a href="{{ route('admin.customers.orders', $customer) }}"
                                    class="btn btn-sm btn-outline-info">
                                    Commandes
                                </a>
                                <form action="{{ route('admin.customers.destroy', $customer) }}"
                                    method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Supprimer ce client ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                Aucun client trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- PAGINATION --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $customers->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection