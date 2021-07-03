<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Cart;
use App\Models\Category;

class SearchResultComponent extends Component
{

    public $sorting;
    public $productPerPage;

    public $search;
    public $product_category;
    public $product_category_id;

    public function mount()
    {
        $this->sorting = "default";

        $this->productPerPage = 12;

        $this->fill(request()->only('search', 'product_category', 'product_category_id'));
    }

    //function for shopping cart
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');

        session()->flash('success_message', 'Item added in Cart');

        return redirect()->route('product.cart');
    }

    //code for shop page
    use WithPagination;

    public function render()
    {
        if ($this->sorting == 'date') {
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')
                ->where('category_id', 'LIKE', '%' . $this->product_category_id . '%')
                ->orderBy('created_at', 'DESC')->paginate($this->productPerPage);
        } else if ($this->sorting == "low_to_high_price") {
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')
                ->where('category_id', 'LIKE', '%' . $this->product_category_id . '%')
                ->orderBy('regular_price', 'ASC')->paginate($this->productPerPage);
        } else if ($this->sorting == "high_to_low_price") {
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')
                ->where('category_id', 'LIKE', '%' . $this->product_category_id . '%')
                ->orderBy('regular_price', 'DESC')->paginate($this->productPerPage);
        } else {
            $products = Product::where('name', 'LIKE', '%' . $this->search . '%')
                ->where('category_id', 'LIKE', '%' . $this->product_category_id . '%')
                ->paginate($this->productPerPage);
        }

        //fetch all category
        $categories = Category::all();

        return view('livewire.search-result-component', [
            'products' => $products,
            'categories' => $categories
        ])
            ->layout("layouts.base");
    }
}
