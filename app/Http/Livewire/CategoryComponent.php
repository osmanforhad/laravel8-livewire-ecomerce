<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Cart;
use App\Models\Category;

class CategoryComponent extends Component
{

    public $sorting;

    public $productPerPage;

    public $category_slug;

    public function mount($category_slug)
    {
        $this->sorting = "default";

        $this->productPerPage = 12;

        $this->category_slug = $category_slug;
    }

    //function for shopping cart
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');

        session()->flash('success_message', 'Item added in Cart');

        return redirect()->route('product.cart');
    }


    use WithPagination;

    public function render()
    {

        //fetch category by slug
        $category = Category::where('slug', $this->category_slug)->first();

        //storing the category ID and Name
        $category_id = $category->id;
        $category_name = $category->name;


        if ($this->sorting == 'date') {
            $products = Product::where('category_id', $category_id)->orderBy('created_at', 'DESC')
                ->paginate($this->productPerPage);
        } else if ($this->sorting == "low_to_high_price") {
            $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'ASC')
                ->paginate($this->productPerPage);
        } else if ($this->sorting == "high_to_low_price") {
            $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'DESC')
                ->paginate($this->productPerPage);
        } else {
            $products = Product::where('category_id', $category_id)->paginate($this->productPerPage);
        }

        //fetch all category
        $categories = Category::all();

        return view('livewire.category-component', [
            'products' => $products,
            'categories' => $categories,
            'category_name' => $category_name
        ])->layout("layouts.base");
    }
}
