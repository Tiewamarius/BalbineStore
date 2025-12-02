<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\products;
use App\Models\productVariant;
use Illuminate\Support\Str;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = products::with('categories')->get();

        foreach ($products as $product) {

            $variants = $this->generateVariantsByCategory($product);

            foreach ($variants as $variant) {

                productVariant::create([
                    'product_id' => $product->id,
                    'name'       => $variant['name'],
                    'sku'        => $this->generateSKU($product, $variant),
                    'price'      => $variant['price'],
                    'stock'      => $variant['stock'],

                    // ATTRIBUTES → JSON (size + color)
                    'attributes' => json_encode([
                        'size'  => $variant['size'],
                        'color' => $variant['color'],
                    ]),

                    // Par défaut actif
                    'is_active'  => true,
                ]);
            }
        }
    }

    /**
     * Génération des variantes selon la catégorie
     */
    private function generateVariantsByCategory($product)
    {
        $categories = strtolower($product->categories->name);

        // 1️⃣ Nettoyages & Entretiens Locaux
        if (str_contains($categories, 'nettoyages') || str_contains($categories, 'entretien')) {
            return [
                ['name' => '500 ml', 'size' => '500ml', 'color' => null, 'stock' => rand(5, 40), 'price' => $product->price - 1500],
                ['name' => '1 Litre', 'size' => '1L', 'color' => null, 'stock' => rand(5, 40), 'price' => $product->price],
                ['name' => '5 Litres', 'size' => '5L', 'color' => null, 'stock' => rand(5, 40), 'price' => $product->price + 5000],
            ];
        }

        // 2️⃣ Traitement Phytosanitaire
        if (str_contains($categories, 'phyto')) {
            return [
                ['name' => 'Dose 25%', 'size' => '25%', 'color' => null, 'stock' => rand(8, 30), 'price' => $product->price],
                ['name' => 'Dose 50%', 'size' => '50%', 'color' => null, 'stock' => rand(8, 30), 'price' => $product->price + 3000],
                ['name' => 'Dose 75%', 'size' => '75%', 'color' => null, 'stock' => rand(8, 30), 'price' => $product->price + 6000],
            ];
        }

        // 3️⃣ Paysagisme & Jardinage
        if (str_contains($categories, 'jardin') || str_contains($categories, 'paysag')) {
            return [
                ['name' => 'Petit modèle', 'size' => 'S', 'color' => null, 'stock' => rand(5, 25), 'price' => $product->price - 2000],
                ['name' => 'Moyen modèle', 'size' => 'M', 'color' => null, 'stock' => rand(5, 25), 'price' => $product->price],
                ['name' => 'Grand modèle', 'size' => 'L', 'color' => null, 'stock' => rand(5, 25), 'price' => $product->price + 3000],
            ];
        }

        // 4️⃣ Parfumage d’Espace
        if (str_contains($categories, 'parfum')) {
            return [
                ['name' => '100 ml', 'size' => '100ml', 'color' => null, 'stock' => rand(10, 35), 'price' => $product->price - 1500],
                ['name' => '250 ml', 'size' => '250ml', 'color' => null, 'stock' => rand(10, 35), 'price' => $product->price],
                ['name' => '500 ml', 'size' => '500ml', 'color' => null, 'stock' => rand(10, 35), 'price' => $product->price + 3000],
            ];
        }

        // Par défaut
        return [
            ['name' => 'Standard', 'size' => 'STD', 'color' => null, 'stock' => rand(10, 30), 'price' => $product->price],
        ];
    }

    /**
     * Génère un SKU unique
     */
    private function generateSKU($product, $variant)
    {
        do {
            $sku = strtoupper(substr(Str::slug($product->name, ''), 0, 6))
                . '-' . strtoupper($variant['size'])
                . '-' . rand(100, 999);
        } while (productVariant::where('sku', $sku)->exists());

        return $sku;
    }
}
