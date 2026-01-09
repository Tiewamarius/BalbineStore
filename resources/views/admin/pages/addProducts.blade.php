@extends('admin.AdminDashboard')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Ajouter un produit</h4>

    <form action="{{ route('admin.products.storeProduct') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nom du produit</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label>Catégorie</label>
                <select name="categories_id" class="form-control" required>
                    <option value="">-- Choisir --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>Marque</label>
                <select name="brand_id" class="form-control" required>
                    @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Description</label>
                <textarea name="description" style="background:whitesmook" class="form-control" rows="4"></textarea>
            </div>

            <div class="col-md-3 mb-3">
                <label>Prix</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label>Prix promotionnel</label>
                <input type="number" name="discount_price" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Stock</label>
                <input type="number" name="stock" class="form-control" required>
            </div>

            <div class="col-md-3 mb-3">
                <label>Unité</label>
                <input type="text" name="unit" class="form-control" placeholder="ml, g, pcs">
            </div>

            <div class="col-md-12 mb-4">
                <label>Images du produit</label>
                <input type="file" name="images[]" class="form-control" multiple>
                <small class="text-muted">La première image sera l’image principale</small>
            </div>

            <div class="col-md-12">
                <button class="btn btn-primary">
                    Ajouter le produit
                </button>
            </div>
        </div>
    </form>
</div>
@endsection