<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\products;
use App\Models\brands;
use App\Models\orders;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{

    // Search + pagination
    public function SearchProducts(Request $request)
    {
        $search  = $request->input('search');
        $perPage = $request->input('per_page', 4);

        $products = Products::with(['categories', 'brand'])
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('price', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
        $pendingOrdersCount = orders::where('status', 'pending')->count();

        return view('admin.pages.allProducts', compact('products', 'pendingOrdersCount'));
    }



    public function AllProducts()
    {
        return view('admin.pages.allProducts', [
            'products' => products::with(['category', 'brand'])->get()
        ]);
    }


    public function showProduct($id)
    {
        $product = products::with(['category', 'brand', 'images'])
            ->findOrFail($id);

        return view('admin.pages.showProduct', compact('product'));
    }
    public function Addproducts()
    {
        return view('admin.pages.addproducts', [
            'categories' => categories::all(),
            'brands' => brands::all(),
        ]);
    }

    public function StoreProduct(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'categories_id'  => 'required|exists:categories,id',
            'brand_id'       => 'required|exists:brands,id',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'unit'           => 'required|string|max:20',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = products::create([
            'name'           => $request->name,
            'slug'           => Str::slug($request->name) . '-' . uniqid(),
            'categories_id'  => $request->categories_id,
            'brand_id'       => $request->brand_id,
            'description'    => $request->description,
            'price'          => $request->price,
            'discount_price' => $request->discount_price,
            'stock'          => $request->stock,
            'unit'           => $request->unit,
            'is_active'      => true,
        ]);

        // Images (relation images())
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('images/products', 'public');

                $product->images()->create([
                    'image_path' => $path,
                    'is_main'    => $index === 0,
                ]);
            }
        }

        return redirect()
            ->route('admin.pages.allproducts')
            ->with('success', 'Produit ajouté avec succès');
    }

    public function editProduct($id)
    {
        $product = products::with('images')->findOrFail($id);

        return view('admin.pages.editProduct', [
            'product'    => $product,
            'categories' => categories::all(),
            'brands'     => brands::all(),
        ]);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = products::findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255',
            'categories_id'  => 'required|exists:categories,id',
            'brand_id'       => 'required|exists:brands,id',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'unit'           => 'required|string|max:20',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product->update([
            'name'           => $request->name,
            'slug'           => Str::slug($request->name),
            'categories_id'  => $request->categories_id,
            'brand_id'       => $request->brand_id,
            'description'    => $request->description,
            'price'          => $request->price,
            'discount_price' => $request->discount_price,
            'stock'          => $request->stock,
            'unit'           => $request->unit,
        ]);

        // Ajout de nouvelles images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/products', 'public');

                $product->images()->create([
                    'image_path' => $path,
                    'is_main' => false,
                ]);
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Produit modifié avec succès');
    }


    // deleted
    public function destroy($id)
    {
        $product = products::findOrFail($id);

        // Suppression images si besoin
        // Storage::delete($product->image);

        $product->delete();

        return redirect()
            ->back()
            ->with('success', 'Produit supprimé avec succès');
    }
}
