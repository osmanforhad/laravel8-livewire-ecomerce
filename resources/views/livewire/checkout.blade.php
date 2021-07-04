<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Checkout</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <form wire:submit.prevent="placeOrder">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrap-address-billing">
                        <h3 class="box-title">Billing Address</h3>
                        <div class="billing-address">
                            <p class="row-in-form">
                                <label for="fname">first name<span>*</span></label>
                                <input type="text" wire:model="firstname"
                                 name="fname" value="" placeholder="Your name">
                                 @error('firstname')
                                     <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="lname">last name<span>*</span></label>
                                <input type="text" wire:model="lastname" 
                                name="lname" value="" placeholder="Your last name">
                                @error('lastname')
                                <span class="text-danger">{{$message}}</span>
                               @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="email">Email Addreess:</label>
                                <input type="email" wire:model="email"
                                 name="email" value="" placeholder="Type your email">
                                 @error('email')
                                 <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="phone">Phone number<span>*</span></label>
                                <input type="number" wire:model="mobile"
                                 name="phone" value="" placeholder="10 digits format">
                                 @error('mobile')
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="add">Address Line1:</label>
                                <input type="text" wire:model="line1"
                                 name="add" value="" placeholder="Street at apartment number">
                                 @error('line1')
                                 <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="add">Address Line2:</label>
                                <input type="text" wire:model="line2"
                                 name="add" value="" placeholder="Street at apartment number">
                            </p>
                            <p class="row-in-form">
                                <label for="country">Country<span>*</span></label>
                                <input type="text" wire:model="country"
                                 name="country" value="" placeholder="United States">
                                 @error('country')
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="city">Province<span>*</span></label>
                                <input type="text" wire:model="province"
                                 name="province" value="" placeholder="Province">
                                 @error('province')
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="city">Town / City<span>*</span></label>
                                <input type="text" wire:model="city"
                                 name="city" value="" placeholder="City name">
                                 @error('city')
                                 <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </p>
                            <p class="row-in-form">
                                <label for="zip-code">Postcode / ZIP:</label>
                                <input type="number" wire:model="zipcode"
                                 name="zip-code" value="" placeholder="Your postal code">
                                 @error('zipcode')
                                 <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </p>
                            <p class="row-in-form fill-wife">
                                <label class="checkbox-field">
                                    <input name="different-add" wire:model="ship_to_different_address"
                                    id="different-add" value="1" type="checkbox">
                                    <span>Ship to a different address?</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
                @if ($ship_to_different_address)
                    <div class="col-md-12">
                        <div class="wrap-address-billing">
                            <h3 class="box-title">Shipping Address</h3>
                            <div class="billing-address">
                                <p class="row-in-form">
                                    <label for="fname">first name<span>*</span></label>
                                    <input type="text" wire:model="ship_firstname"
                                     name="fname" value="" placeholder="Your name">
                                     @error('ship_firstname')
                                     <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="lname">last name<span>*</span></label>
                                    <input type="text" wire:model="ship_lastname"
                                     name="lname" value="" placeholder="Your last name">
                                     @error('ship_lastname')
                                     <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="email">Email Addreess:</label>
                                    <input type="email" wire:model="ship_email"
                                     name="email" value="" placeholder="Type your email">
                                     @error('ship_email')
                                     <span class="text-danger">{{$message}}</span>
                                     @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="phone">Phone number<span>*</span></label>
                                    <input type="number" wire:model="ship_mobile"
                                     name="phone" value="" placeholder="10 digits format">
                                     @error('ship_mobile')
                                     <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Address Line1:</label>
                                    <input type="text" wire:model="ship_line1"
                                     name="add" value="" placeholder="Street at apartment number">
                                     @error('ship_line1')
                                     <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="add">Address Line2:</label>
                                    <input type="text" wire:model="ship_line2"
                                     name="add" value="" placeholder="Street at apartment number">
                                </p>
                                <p class="row-in-form">
                                    <label for="country">Country<span>*</span></label>
                                    <input type="text" wire:model="ship_country"
                                     name="country" value="" placeholder="United States">
                                     @error('ship_country')
                                     <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="country">Province<span>*</span></label>
                                    <input type="text" wire:model="ship_province"
                                     name="ship_province" value="" placeholder="Province">
                                     @error('ship_province')
                                     <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="city">Town / City<span>*</span></label>
                                    <input type="text" wire:model="ship_city"
                                     name="city" value="" placeholder="City name">
                                     @error('ship_city')
                                     <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </p>
                                <p class="row-in-form">
                                    <label for="zip-code">Postcode / ZIP:</label>
                                    <input type="number" wire:model="ship_zipcode"
                                     name="zip-code" value="" placeholder="Your postal code">
                                     @error('ship_zipcode')
                                     <span class="text-danger">{{$message}}</span>
                                   @enderror
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
           
            <div class="summary summary-checkout">
                <div class="summary-item payment-method">
                    <h4 class="title-box">Payment Method</h4>
                    <p class="summary-info"><span class="title">Check / Money order</span></p>
                    <p class="summary-info"><span class="title">Credit Cart (saved)</span></p>
                    <div class="choose-payment-methods">
                        <label class="payment-method">
                            <input name="payment-method" wire:model="paymentmode"
                             id="payment-method-bank" value="code" type="radio">
                            <span>Cash on Delivery</span>
                            <span class="payment-desc">Order Now Pay on Delivery</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" wire:model="paymentmode"
                             id="payment-method-visa" value="card" type="radio">
                            <span>Debit / Credit Card</span>
                            <span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
                        </label>
                        <label class="payment-method">
                            <input name="payment-method" wire:model="paymentmode"
                             id="payment-method-paypal" value="paypal" type="radio">
                            <span>Paypal</span>
                            <span class="payment-desc">You can pay with your credit</span>
                            <span class="payment-desc">card if you don't have a paypal account</span>
                        </label>
                        @error('paymentmode')
                        <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                    @if (Session::has('checkout'))
                    <p class="summary-info grand-total">
                        <span>Grand Total</span> 
                        <span class="grand-total-price">{{Session::get('checkout')['total']}}$</span>
                    </p>
                    @endif
                    <button type="submit" class="btn btn-medium">Place order now</button>
                </div>
                <div class="summary-item shipping-method">
                    <h4 class="title-box f-title">Shipping method</h4>
                    <p class="summary-info"><span class="title">Flat Rate</span></p>
                    <p class="summary-info"><span class="title">Fixed 0$</span></p>
                </div>
            </div>
        </form>
        </div><!--end main content area-->
    </div><!--end container-->

</main>