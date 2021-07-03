<div class="wrap-icon-section minicart">
    <a href="{{route('product.cart')}}" class="link-direction">
        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
        <div class="left-info">
            @if (Cart::instance('addtocart')->count() > 0)
            <span class="index">{{Cart::instance('addtocart')->count()}} items</span>
            @endif
            <span class="title">CART</span>
        </div>
    </a>
</div>