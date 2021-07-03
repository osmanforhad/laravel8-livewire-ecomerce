<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\OnSale;
use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        //fetch active slider for home page
        $sliders = HomeSlider::where('status', 1)->get();

        //fetch latest product for display in home page by created date
        $latestProducts = Product::orderBy('created_at', 'DESC')->get()->take(8);

        //fetch category for display in home page
        $category = HomeCategory::find(1);
        //convert string to array
        $cats = explode(',', $category->sel_categories);
        //makes sure if the provided column's value exists inside the given array
        $categories = Category::whereIn('id', $cats)->get();
        $no_of_products = $category->no_of_products;

        //fetch product by onRandomOrder for OnSale Product section
        $onSaleProducts = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);

        //fetch onSale timer record
        $onSaleTimer = OnSale::find(1);

        return view('livewire.home', [
            'sliders' => $sliders,
            'latestProducts' => $latestProducts,
            'categories' => $categories,
            'no_of_products' => $no_of_products,
            'onSaleProducts' => $onSaleProducts,
            'onSaleTimer' => $onSaleTimer
        ])
            ->layout('layouts.base');
    }
}
