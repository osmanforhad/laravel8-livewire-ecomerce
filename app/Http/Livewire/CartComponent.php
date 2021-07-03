<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use Livewire\Component;
use Cart;
use Illuminate\Support\Carbon;

class CartComponent extends Component
{
    public $haveCouponeCode;

    public $couponeCode;

    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

    //function for add quantity in cart using pluse icon
    public function increaseCartQuantity($rowId)
    {
        $product = Cart::instance('addtocart')->get($rowId);

        $qty = $product->qty + 1;

        Cart::instance('addtocart')->update($rowId, $qty);

        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    //function for minuse quantity in cart using minuse icon
    public function decreaseCartQuantity($rowId)
    {
        $product = Cart::instance('addtocart')->get($rowId);

        $qty = $product->qty - 1;

        Cart::instance('addtocart')->update($rowId, $qty);

        $this->emitTo('cart-count-component', 'refreshComponent');
    }

    //function for delete single cart item
    public function destroyCartItem($rowId)
    {
        Cart::instance('addtocart')->remove($rowId);

        $this->emitTo('cart-count-component', 'refreshComponent');

        session()->flash('success_message', 'Item has been removed');
    }

    //function for delete all cart item
    public function destroyAllCartItem()
    {
        Cart::instance('addtocart')->destroy();

        $this->emitTo('cart-count-component', 'refreshComponent');

        session()->flash('success_message', 'All Cart Item has been Clear');
    }

    //function for save later
    public function switchToSaveForLater($rowId)
    {
        $item = Cart::instance('addtocart')->get($rowId);
        Cart::instance('addtocart')->remove($rowId);

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        $this->emitTo('cart-count-component', 'refreshComponent');

        session()->flash('success_message', 'Item has been save for later');
    }

    //function for switch move to cart from saved for later
    public function moveToCart($rowId)
    {
        $item = Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);

        Cart::instance('addtocart')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        $this->emitTo('cart-count-component', 'refreshComponent');

        session()->flash('s_success_message', 'Item has been moved to cart');
    }

    //function for delte product from save for later
    public function deleteFromSaveForLater($rowId)
    {
        Cart::instance('saveForLater')->remove($rowId);

        session()->flash('s_success_message', 'Item has been removed from save for later');
    }

    //function for coupone code
    public function applyCouponeCode()
    {
        $coupon = Coupon::where('code', $this->couponeCode)->where('expiry_date', '>=', Carbon::today())
            ->where('cart_value', '<=', Cart::instance('addtocart')
                ->subtotal())->first();

        if (!$coupon) {

            session()->flash('coupon_message', 'Coupon code is invalid!');
            return;
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
    }

    //function for discount calculation
    public function calculateDiscounts()
    {
        if (session()->has('coupon')) {

            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (Cart::instance('addtocart')->subtotal() * session()->get('coupon')['value']) / 100;
            }

            $this->subtotalAfterDiscount = Cart::instance('addtocart')->subtotal() - $this->discount;

            $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax')) / 100;

            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    //function for remove coupon
    public function removeCoupon()
    {
        session()->forget('coupon');
    }


    public function render()
    {
        if (session()->has('coupon')) {

            if (
                Cart::instance('addtocart')->subtotal() < session()->get('coupon')['cart_value']
            ) {
                session()->forget('coupon');
            } else {
                $this->calculateDiscounts();
            }
        }

        return view('livewire.cart-component')->layout("layouts.base");
    }
}
