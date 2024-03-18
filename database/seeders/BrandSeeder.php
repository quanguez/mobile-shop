<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(public_path('json\brands.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $record = Brand::where('slug', $item['slug'])->first();
            if (!$record) {
                Brand::query()->create([
                    'name' => $item['name'],
                    'slug' => $item['slug'],
                    'image' => $item['image'],
                    'is_active' => $item['is_active'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
