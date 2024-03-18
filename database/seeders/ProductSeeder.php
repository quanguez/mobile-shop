<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(public_path('json\products.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $slug_pro_tmp = Str::slug($item['title']);
            $category = Category::where('slug', $item['category'])->first();
            $brand = Brand::where('slug', $item['brand'])->first();
            $record = Product::where('slug', $slug_pro_tmp)->first();
            if (!$record && $brand && $category) {
                Product::query()->create([
                    'category_slug' => $item['category'],
                    'brand_slug' => $item['brand'],
                    'name' => $item['title'],
                    'slug' => $slug_pro_tmp,
                    'thumbnail' => $item['thumbnail'],
                    'images' => $item['images'],
                    'description' => $item['description'],
                    'stock' => $item['stock'],
                    'old_price' => $item['price'],
                    'new_price' => $item['price'] * (1 - $item['discountPercentage'] / 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
