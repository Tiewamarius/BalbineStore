<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Product_Images;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Créons ou récupérons une catégorie et une marque
        $category = Categories::firstOrCreate([
            'name' => 'Soins du visage',
        ], [
            'slug' => Str::slug('Soins du visage'),
        ]);

        $brand = Brands::firstOrCreate(
            ['name' => 'Balbine Beauty'],
            ['slug' => Str::slug('Balbine Beauty')]
        );

        // 🔹 Exemple d’un tableau de produits dynamiques
        $products = [
            [
                'name' => 'Crème hydratante à l’aloe vera',
                'description' => 'Une crème légère et nourrissante adaptée à tous les types de peau.',
                'price' => 12000,
                'discount_price' => 9500,
                'stock' => 20,
                'unit' => 'ml',
                'is_active' => true,
            ],
            [
                'name' => 'Masque purifiant au charbon',
                'description' => 'Masque nettoyant profond qui élimine les impuretés.',
                'price' => 8500,
                'discount_price' => null,
                'stock' => 15,
                'unit' => 'ml',
                'is_active' => true,
            ],
            [
                'name' => 'Sérum éclat à la vitamine C',
                'description' => 'Sérum antioxydant pour un teint lumineux et uniforme.',
                'price' => 15000,
                'discount_price' => 13000,
                'stock' => 8,
                'unit' => 'ml',
                'is_active' => true,
            ],
        ];

        // 🔹 Boucle d’insertion
        foreach ($products as $data) {
            $product = Products::create([
                'categories_id'    => $category->id,
                'brand_id'       => $brand->id,
                'name'           => $data['name'],
                'slug'           => Str::slug($data['name']),
                'description'    => $data['description'],
                'price'          => $data['price'],
                'discount_price' => $data['discount_price'],
                'stock'          => $data['stock'],
                'unit'           => $data['unit'],
                'is_active'      => $data['is_active'],
            ]);

            // 🔹 Images associées
            $images = [
                'images/products/default1.jpg',
                'images/products/default2.jpg',
            ];

            foreach ($images as $index => $imgPath) {
                $product->images()->create([
                    'image_path' => $imgPath,
                    'is_main'    => $index === 0, // première image principale
                ]);
            }
        }
    }
}
