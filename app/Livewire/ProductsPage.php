<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product - DewShop')]
class ProductsPage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->get(['id', 'name', 'slug']);
        $brands = Brand::where('is_active', 1)->get(['id', 'name', 'slug']);
        $productsQuery = Product::query()->where('is_active', 1);
        return view('livewire.products-page', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $productsQuery->paginate(6),
        ]);
    }
}
