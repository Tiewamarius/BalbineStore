@extends('admin.AdminDashboard')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Tous les produits - BALBINE STORE</h5>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="{{ route('products.create') }}" class="btn bg-gradient-dark btn-sm mb-0">+&nbsp; Nouveau Produit</a>

                            <a href="{{ route('products.export.all') }}" class="btn btn-outline-primary btn-sm mb-0">Tout Exporter</a>
                            <a href="{{ route('products.export.delivery') }}" class="btn btn-outline-success btn-sm mb-0">Export Livraison</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body px-0 pb-0">
                <div class="table-responsive">
                    <table class="table table-flush" id="products-list">
                        <thead class="thead-light">
                            <tr>
                                <th><input class="form-check-input" type="checkbox"></th>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="form-check my-auto" style="padding: 15px;">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                        <img class="avatar avatar-sm me-3" src="{{ $product->main_image_url }}" alt="{{ $product->name }}">

                                    </div>
                                </td>

                                <td class="text-sm">{{ $product->name ?? 'N/A' }}</td>
                                <td class="text-sm">{{ $product->categories->name ?? 'N/A' }}</td>

                                <td class="text-sm">
                                    {{ number_format($product->price, 0, ',', ' ') }} {{'FCFA' }}
                                </td>

                                <td class="text-sm">{{ $product->stock }}</td>
                                <td>
                                    @php
                                    $badgeColor = match($product->stock_status) {
                                    'Rupture de stock' => 'badge-danger',
                                    'Stock limité' => 'badge-warning',
                                    default => 'badge-success',
                                    };
                                    @endphp
                                    <span class="badge {{ $badgeColor }} badge-sm">{{ $product->stock_status }}</span>
                                </td>

                                <td class="text-sm">
                                    <a href="{{ route('products.show', $product->id) }}" data-bs-toggle="tooltip" title="Voir">
                                        <i class="material-symbols-rounded text-secondary text-lg">visibility</i>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="mx-3" data-bs-toggle="tooltip" title="Modifier">
                                        <i class="material-symbols-rounded text-secondary text-lg">drive_file_rename_outline</i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 m-0" onclick="return confirm('Supprimer ce produit ?')">
                                            <i class="material-symbols-rounded text-secondary text-lg">delete</i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center p-4">Aucun produit en base de données.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection