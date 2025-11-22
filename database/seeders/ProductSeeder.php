<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\products;
use App\Models\categories;
use App\Models\brands;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Création des catégories
        $categoryNames = [
            'Nettoyages & Entretiens Locaux',
            'Traitement Phytosanitaire',
            'Paysagisme & Jardinage',
            'Parfumage d\'Espace',
        ];

        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[] = categories::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }

        // 🔹 Création d'une marque par défaut
        $brand = brands::firstOrCreate(
            ['name' => 'Balbine Beauty'],
            ['slug' => Str::slug('Balbine Beauty')]
        );

        // 🔹 Produits pour la première catégorie
        $products = [
            [
                'name' => 'Produit 1',
                'description' => 'Description du produit 1',
                'price' => 12000,
                'discount_price' => 10000,
                'stock' => 10,
                'unit' => 'ml',
                'is_active' => true,
            ],
            [
                'name' => 'Produit 2',
                'description' => 'Description du produit 2',
                'price' => 15000,
                'discount_price' => null,
                'stock' => 15,
                'unit' => 'ml',
                'is_active' => true,
            ],
            [
                'name' => 'Produit 3',
                'description' => 'Description du produit 3',
                'price' => 9000,
                'discount_price' => 8500,
                'stock' => 8,
                'unit' => 'ml',
                'is_active' => true,
            ],
            [
                'name' => 'Produit 4',
                'description' => 'Description du produit 4',
                'price' => 20000,
                'discount_price' => 18000,
                'stock' => 5,
                'unit' => 'ml',
                'is_active' => true,
            ],
            [
                'name' => 'Produit 5',
                'description' => 'Description du produit 5',
                'price' => 11000,
                'discount_price' => null,
                'stock' => 12,
                'unit' => 'ml',
                'is_active' => true,
            ],
        ];

        // 🔹 Boucle d'insertion des produits avec images
        $firstCategory = $categories[0]; // On prend la première catégorie
        foreach ($products as $data) {
            $product = products::create([
                'categories_id' => $firstCategory->id,
                'brand_id' => $brand->id,
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['description'],
                'price' => $data['price'],
                'discount_price' => $data['discount_price'],
                'stock' => $data['stock'],
                'unit' => $data['unit'],
                'is_active' => $data['is_active'],
            ]);

            // 🔹 Images associées (3 images par produit)
            $images = [
                'images/products/default1.jpg',
                'images/products/default2.jpg',
                'images/products/default3.jpg',
            ];

            foreach ($images as $index => $imgPath) {
                $product->images()->create([
                    'image_path' => $imgPath,
                    'is_main' => $index === 0,
                ]);
            }
        }
    }
}
