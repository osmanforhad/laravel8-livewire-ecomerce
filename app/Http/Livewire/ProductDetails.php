<?php

namespace App\Http\Livewire;

use App\Models\OnSale;
use App\Models\Product;
use Livewire\Component;
use Cart;

class ProductDetails extends Component
{
    public $slug;
    public $quantity;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->quantity = 1;
    }

    //function for shopping cart
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('addtocart')->add($product_id, $product_name, $this->quantity, $product_price)->associate('App\Models\Product');

        session()->flash('success_message', 'Item added in Cart');

        return redirect()->route('product.cart');
    }

    //function for increase Quantity
    public function incereaseQuantity()
    {
        $this->quantity++;
    }

    //function for decrease Quantity
    public function decereaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();

        $popular_products = Product::inRandomOrder()->limit(4)->get();

        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(7)->get();

        $onSaleTimerProduct = OnSale::find(1);

        return view('livewire.product-details', [
            'product' => $product,
            'popular_products' => $popular_products,
            'related_products' => $related_products,
            'onSaleTimerProduct' => $onSaleTimerProduct
        ])
            ->layout('layouts.base');
    }
}
