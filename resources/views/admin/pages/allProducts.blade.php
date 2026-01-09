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
                        <a href="{{ route('admin.pages.Addproducts') }}"
                            class="btn bg-gradient-dark btn-sm mb-0">
                            +&nbsp; Nouveau Produit
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body px-0 pb-0">
                <div class="table-responsive">

                    {{-- TOP BAR --}}
                    <div class="dataTable-top d-flex justify-content-between align-items-center px-3">

                        {{-- PER PAGE --}}
                        <form method="GET" action="{{ route('admin.pages.allproducts') }}">
                            <label class="d-flex align-items-center gap-2">
                                <select name="per_page"
                                    class="dataTable-selector"
                                    onchange="this.form.submit()">
                                    @foreach([5,10,15,20,25] as $size)
                                    <option value="{{ $size }}"
                                        {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                        {{ $size }}
                                    </option>
                                    @endforeach
                                </select>
                                entries per page
                            </label>

                            {{-- conserver la recherche --}}
                            @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            @endif
                        </form>

                        {{-- SEARCH --}}
                        <form method="GET" action="{{ route('admin.pages.allproducts') }}">
                            <input type="text"
                                name="search"
                                class="dataTable-input"
                                placeholder="Rechercher un produit..."
                                value="{{ request('search') }}">

                            {{-- conserver le per_page --}}
                            @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                            @endif
                        </form>

                    </div>

                    {{-- TABLE --}}
                    <table class="table table-flush" id="products-list">
                        <thead class="thead-light">
                            <tr>
                                <th><input class="form-check-input" type="checkbox"></th>
                                <th>Produit</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input class="form-check-input me-2" type="checkbox">
                                        <img class="avatar avatar-sm"
                                            src="{{ $product->main_image_url }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                </td>

                                <td class="text-sm">{{ $product->name ?? 'N/A' }}</td>
                                <td class="text-sm">{{ $product->categories->name ?? 'N/A' }}</td>
                                <td class="text-sm">
                                    {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                </td>
                                <td class="text-sm">{{ $product->stock }}</td>

                                <td class="text-sm">
                                    <a href="{{ route('admin.products.editProduct', $product->id) }}"
                                        class="mx-2"
                                        data-bs-toggle="tooltip"
                                        title="Modifier">
                                        <i class="material-symbols-rounded text-secondary text-lg">
                                            drive_file_rename_outline
                                        </i>
                                    </a>

                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                        method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-link p-0 m-0"
                                            onclick="return confirm('Supprimer ce produit ?')">
                                            <i class="material-symbols-rounded text-danger text-lg">
                                                delete
                                            </i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center p-4">
                                    Aucun produit en base de données.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- PAGINATION --}}
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection