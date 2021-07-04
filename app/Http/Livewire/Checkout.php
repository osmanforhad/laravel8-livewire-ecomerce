<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;

class Checkout extends Component
{

    public $firstname;
    public $lastname;
    public $email;
    public $mobile;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $country;
    public $zipcode;

    public $ship_to_different_address;

    public $ship_firstname;
    public $ship_lastname;
    public $ship_email;
    public $ship_mobile;
    public $ship_line1;
    public $ship_line2;
    public $ship_city;
    public $ship_province;
    public $ship_country;
    public $ship_zipcode;

    public $paymentmode;

    public $thankyou;

    //livewire hook function for validation
    public function validationSetup($fields)
    {
        $this->validateOnly($fields, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required | email',
            'mobile' => 'required | numeric',
            'line1' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'paymentmode' => 'required'
        ]);

        if ($this->ship_to_different_address) {

            $this->validateOnly($fields, [
                'ship_firstname' => 'required',
                'ship_lastname' => 'required',
                'ship_email' => 'required | email',
                'ship_mobile' => 'required | numeric',
                'ship_line1' => 'required',
                'ship_city' => 'required',
                'ship_province' => 'required',
                'ship_country' => 'required',
                'ship_zipcode' => 'required',
            ]);
        }
    }

    //function for placeOrder
    public function placeOrder()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required | email',
            'mobile' => 'required | numeric',
            'line1' => 'required',
            'city' => 'required',
            'province' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'paymentmode' => 'required'
        ]);

        $order = new Order();

        $order->user_id = Auth::user()->id;

        $order->sub_total = session()->get('checkout')['subtotal'];
        $order->discount = session()->get('checkout')['discount'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];

        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->email = $this->email;
        $order->mobile = $this->mobile;
        $order->line1 = $this->line1;
        $order->line2 = $this->line2;
        $order->city = $this->city;
        $order->province = $this->province;
        $order->country = $this->country;
        $order->zipcode = $this->zipcode;
        //default define
        $order->status = 'ordered';
        //for different shipping address
        $order->is_shipping_different = $this->ship_to_different_address ? 1 : 0;

        $order->save();

        foreach (Cart::instance('addtocart')->content() as $cart) {

            $orderItem = new OrderItem();

            $orderItem->product_id = $cart->id;
            $orderItem->order_id = $order->id;
            $orderItem->price = $cart->price;
            $orderItem->quantity = $cart->qty;

            $orderItem->save();
        }

        //condition for different shipping addess
        if ($this->ship_to_different_address) {

            $this->validate([
                'ship_firstname' => 'required',
                'ship_lastname' => 'required',
                'ship_email' => 'required | email',
                'ship_mobile' => 'required | numeric',
                'ship_line1' => 'required',
                'ship_city' => 'required',
                'ship_province' => 'required',
                'ship_country' => 'required',
                'ship_zipcode' => 'required',
            ]);

            $shipping = new Shipping();

            $shipping->order_id = $order->id;

            $shipping->firstname = $this->ship_firstname;
            $shipping->lastname = $this->ship_lastname;
            $shipping->email = $this->ship_email;
            $shipping->mobile = $this->ship_mobile;
            $shipping->line1 = $this->ship_line1;
            $shipping->line2 = $this->ship_line2;
            $shipping->city = $this->ship_city;
            $shipping->province = $this->ship_province;
            $shipping->country = $this->ship_country;
            $shipping->zipcode = $this->ship_zipcode;

            $shipping->save();
        }

        //condition for cash on deliery
        if ($this->paymentmode == 'code') {

            $transaction = new Transaction();

            $transaction->user_id = Auth::user()->id;
            $transaction->order_id = $order->id;
            $transaction->mode = 'code';
            $transaction->status = 'pending';

            $transaction->save();
        }

        $this->thankyou = 1;

        Cart::instance('addtocart')->destroy();
        session()->forget('checkout');
    }

    //function for verify chekout
    public function verifyForCheckout()
    {
        if (!Auth::check()) {

            return redirect()->route('login');
        } 
        else if ($this->thankyou) {

            return redirect()->route('thankyou');
        } 
        else if (!session()->get('checkout')) {

            return redirect()->route('product.cart');
        }
    }

    public function render()
    {
        $this->verifyForCheckout();

        return view('livewire.checkout')->layout("layouts.base");
    }
}
