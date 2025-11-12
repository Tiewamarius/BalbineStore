@extends('layouts.admin')

@section('content')
<h2>Ajouter un produit</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label>Nom du produit</label>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Catégorie</label>
        <select name="category_id" required>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Marque</label>
        <select name="brand_id">
            <option value="">Aucune</option>
            @foreach($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Prix</label>
        <input type="number" step="0.01" name="price" required>
    </div>

    <div>
        <label>Stock</label>
        <input type="number" name="stock" required>
    </div>

    <div>
        <label>Images</label>
        <input type="file" name="images[]" multiple>
        <small>La première image sera utilisée comme principale si non précisé.</small>
    </div>

    <div>
        <label>Index de l’image principale (0,1,2...)</label>
        <input type="number" name="main_image" value="0">
    </div>

    <button type="submit">Enregistrer</button>
</form>

@endsection