<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brands;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brandNames = [
            'PROMASTER',
            'CALIVOIR',
            'A2P',
            'ALMAO',
            'NDS',
        ];

        foreach ($brandNames as $name) {
            Brands::firstOrCreate(
                ['name' => $name],
                [
                    'slug' => Str::slug($name),
                    'description' => 'Marque ' . $name,
                    'logo' => 'images/brands/' . Str::slug($name) . '.png',
                    'is_active' => true,
                ]
            );
        }
    }
}
