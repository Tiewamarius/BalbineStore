<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\categories;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categoryNames = [
            'Nettoyages & Entretiens Locaux',
            'Traitement Phytosanitaire',
            'Paysagisme & Jardinage',
            'Parfumage d\'Espace',
        ];

        foreach ($categoryNames as $name) {
            categories::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}
