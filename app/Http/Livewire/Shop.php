<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Cart;
use App\Models\Category;

class Shop extends Component
{

    public $sorting;

    public $productPerPage;

    //for price filter
    public $min_price;
    public $max_price;

    public function mount()
    {
        $this->sorting = "default";
        $this->productPerPage = 12;

        $this->min_price = 1;
        $this->max_price = 1000;
    }

    //function for shopping cart
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('addtocart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');

        session()->flash('success_message', 'Item added in Cart');

        return redirect()->route('product.cart');
    }

    //function for add to wish list
    public function addToWishList($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)
            ->associate('App\Models\Product');

        //auto refresh the wishlist after added any product
        $this->emitTo('wishlist-count-component', 'refreshComponent');
    }

    //function for remove wishlist product
    public function removeProductFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $wishlistItem) {

            if ($wishlistItem->id == $product_id) {
                Cart::instance('wishlist')->remove($wishlistItem->rowId);

                //auto refresh the wishlist after added any product
                $this->emitTo('wishlist-count-component', 'refreshComponent');

                return;
            }
        }
    }

    //code for shop page pagination
    use WithPagination;

    public function render()
    {
        if ($this->sorting == 'date') {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])
                ->orderBy('created_at', 'DESC')->paginate($this->productPerPage);
        } else if ($this->sorting == "low_to_high_price") {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])
                ->orderBy('regular_price', 'ASC')->paginate($this->productPerPage);
        } else if ($this->sorting == "high_to_low_price") {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])
                ->orderBy('regular_price', 'DESC')->paginate($this->productPerPage);
        } else {
            $products = Product::whereBetween('regular_price', [$this->min_price, $this->max_price])
                ->paginate($this->productPerPage);
        }

        //fetch all category
        $categories = Category::all();

        return view('livewire.shop', ['products' => $products, 'categories' => $categories])
            ->layout("layouts.base");
    }
}
