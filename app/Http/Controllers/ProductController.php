<?php

namespace App\Http\Controllers;


use App\Models\Products;
use App\Models\Categories;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Products::with(['images', 'categories'])
            ->findOrFail($id);

        // Produits complémentaires (même catégorie, aléatoires)
        $relatedProducts = Products::with(['images' => fn($q) => $q->where('is_main', true)])
            ->where('categories_id', $product->categories_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('detailsProduits', compact('product', 'relatedProducts'));
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Categories::all(),
            'brands' => Brands::all(),
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'discount_price'  => 'nullable|numeric|min:0',
            'stock'           => 'required|integer|min:0',
            'unit'            => 'nullable|string|max:50',
            'categories_id'     => 'required|exists:categories,id',
            'brand_id'        => 'nullable|exists:brands,id',
            'is_active'       => 'boolean',
            'images.*'        => 'image|max:2048',
            'main_image'      => 'nullable|integer|min:0', // index de l’image principale
        ]);

        // 🔹 Création du produit
        $product = Products::create([
            'categories_id'    => $validated['categories_id'],
            'brand_id'       => $validated['brand_id'] ?? null,
            'name'           => $validated['name'],
            'slug'           => $validated['slug'] ?? Str::slug($validated['name']),
            'description'    => $validated['description'] ?? '',
            'price'          => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
            'stock'          => $validated['stock'],
            'unit'           => $validated['unit'] ?? 'pièce',
            'is_active'      => $validated['is_active'] ?? true,
        ]);

        // 🔹 Upload des images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image_path' => $path,
                    'is_main'    => $index == ($request->input('main_image') ?? 0), // première image par défaut
                ]);
            }
        }

        return redirect()->back()->with('success', 'Produit ajouté avec succès.');
    }


    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'discount_price'  => 'nullable|numeric|min:0',
            'stock'           => 'required|integer|min:0',
            'unit'            => 'nullable|string|max:50',
            'categories_id'     => 'required|exists:categories,id',
            'brand_id'        => 'nullable|exists:brands,id',
            'is_active'       => 'boolean',
            'images.*'        => 'image|max:2048',
            'main_image'      => 'nullable|integer|min:0',
            'remove_images'   => 'nullable|array', // IDs des images à supprimer
        ]);

        // 🔹 Mise à jour des infos du produit
        $product->update([
            'categories_id'    => $validated['categories_id'],
            'brand_id'       => $validated['brand_id'] ?? null,
            'name'           => $validated['name'],
            'slug'           => $validated['slug'] ?? Str::slug($validated['name']),
            'description'    => $validated['description'] ?? '',
            'price'          => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
            'stock'          => $validated['stock'],
            'unit'           => $validated['unit'] ?? 'pièce',
            'is_active'      => $validated['is_active'] ?? true,
        ]);

        // 🔹 Suppression d’anciennes images si demandé
        if ($request->filled('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = $product->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // 🔹 Upload de nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');

                $product->images()->create([
                    'image_path' => $path,
                    'is_main'    => $index == ($request->input('main_image') ?? 0),
                ]);
            }
        }

        // 🔹 Mise à jour de l’image principale
        if ($request->filled('main_image')) {
            $mainIndex = (int)$request->main_image;

            // Réinitialiser toutes les images à "non principale"
            $product->images()->update(['is_main' => false]);

            // Marquer la bonne image comme principale (par index ou ID)
            $images = $product->images()->get();
            if (isset($images[$mainIndex])) {
                $images[$mainIndex]->update(['is_main' => true]);
            }
        }

        return redirect()->back()->with('success', 'Produit mis à jour avec succès.');
    }
}
