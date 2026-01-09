@extends('admin.AdminDashboard')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Modifier le produit</h4>

        <a href="{{ route('admin.pages.allproducts') }}" class="btn btn-secondary btn-sm">
            ← Retour
        </a>
    </div>

    {{-- Messages --}}
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.products.updateProduct', $product->id) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            {{-- Nom --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Nom du produit</label>
                <input type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $product->name) }}"
                    required>
            </div>

            {{-- Catégorie --}}
            <div class="col-md-3 mb-3">
                <label class="form-label">Catégorie</label>
                <select name="categories_id" class="form-control" required>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $product->categories_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Marque --}}
            <div class="col-md-3 mb-3">
                <label class="form-label">Marque</label>
                <select name="brand_id" class="form-control" required>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}"
                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Description --}}
            <div class="col-md-12 mb-3">
                <label class="form-label">Description</label>
                <textarea name="description"
                    rows="4"
                    class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Prix --}}
            <div class="col-md-3 mb-3">
                <label class="form-label">Prix</label>
                <input type="number"
                    name="price"
                    class="form-control"
                    value="{{ old('price', $product->price) }}"
                    required>
            </div>

            {{-- Prix promo --}}
            <div class="col-md-3 mb-3">
                <label class="form-label">Prix promotionnel</label>
                <input type="number"
                    name="discount_price"
                    class="form-control"
                    value="{{ old('discount_price', $product->discount_price) }}">
            </div>

            {{-- Stock --}}
            <div class="col-md-3 mb-3">
                <label class="form-label">Stock</label>
                <input type="number"
                    name="stock"
                    class="form-control"
                    value="{{ old('stock', $product->stock) }}"
                    required>
            </div>

            {{-- Unité --}}
            <div class="col-md-3 mb-3">
                <label class="form-label">Unité</label>
                <input type="text"
                    name="unit"
                    class="form-control"
                    value="{{ old('unit', $product->unit) }}"
                    required>
            </div>

            {{-- Images existantes --}}
            <div class="col-md-12 mb-4">
                <label class="form-label">Images actuelles</label>

                <div class="d-flex flex-wrap gap-3">
                    @foreach($product->images as $img)
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $img->image_path) }}"
                            width="120"
                            class="rounded border">

                        @if($img->is_main)
                        <span class="badge bg-primary position-absolute top-0 start-0">
                            Principale
                        </span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Ajouter nouvelles images --}}
            <div class="col-md-12 mb-4">
                <label class="form-label">Ajouter des images</label>
                <input type="file"
                    name="images[]"
                    class="form-control"
                    multiple>
                <small class="text-muted">
                    Les nouvelles images seront ajoutées (sans supprimer les anciennes)
                </small>
            </div>

            {{-- Bouton --}}
            <div class="col-md-12">
                <button class="btn btn-primary">
                    Enregistrer les modifications
                </button>
            </div>

        </div>
    </form>
</div>
@endsection