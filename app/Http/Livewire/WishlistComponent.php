<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class WishlistComponent extends Component
{

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

    //functin for moving product wishlist to cart
    public function moveProductFromWistlistToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);

        Cart::instance('wishlist')->remove($rowId);

        Cart::instance('addtocart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        //auto refresh the wishlist after added any product
        $this->emitTo('wishlist-count-component', 'refreshComponent');

        //auto refresh the Cart after added any product
        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    public function render()
    {
        return view('livewire.wishlist-component')->layout('layouts.base');
    }
}
