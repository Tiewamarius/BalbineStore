<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\brands;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brandNames = [
            'Balbine Beauty',
            'Oshun Pro',
            'Floralis',
        ];

        foreach ($brandNames as $name) {
            brands::firstOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name)]
            );
        }
    }
}
