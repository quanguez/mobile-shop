<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(public_path('json\categories.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $record = Category::where('slug', $item['slug'])->first();
            if (!$record) {
                Category::query()->create([
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
