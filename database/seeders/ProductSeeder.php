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
        $categories = categories::all();
        $brand = brands::firstOrCreate(
            ['name' => 'Balbine Beauty'],
            ['slug' => Str::slug('Balbine Beauty')]
        );

        $defaultImages = [
            'images/products/default1.jpg',
            'images/products/default2.jpg',
            'images/products/default3.jpg',
        ];

        foreach ($categories as $category) {

            for ($i = 1; $i <= 10; $i++) {

                $name = "Produit {$i} - {$category->name}";

                $product = products::create([
                    'categories_id' => $category->id,
                    'brand_id' => $brand->id,
                    'name' => $name,
                    'slug' => Str::slug($name . '-' . uniqid()),
                    'description' => "Description de {$name}",
                    'price' => rand(5000, 20000),
                    'discount_price' => rand(0, 1) ? rand(3000, 15000) : null,
                    'stock' => rand(5, 30),
                    'unit' => 'ml',
                    'is_active' => true,
                ]);

                // 3 images
                foreach ($defaultImages as $index => $img) {
                    $product->images()->create([
                        'image_path' => $img,
                        'is_main' => $index === 0,
                    ]);
                }
            }
        }
    }
}
