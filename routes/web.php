<?php

use App\Http\Livewire\Admin\AddCategoryComponent;
use App\Http\Livewire\Admin\AddHomeSiliderComponent;
use App\Http\Livewire\Admin\AddProductComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminCouponComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home;
use App\Http\Livewire\Shop;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\User\UserDashboard;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSilderComponent;
use App\Http\Livewire\Admin\AdminOnSaleComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\EditCategoryComponent;
use App\Http\Livewire\Admin\EditHomeSliderComponent;
use App\Http\Livewire\Admin\EditProductComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\ProductDetails;
use App\Http\Livewire\SearchResultComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\WishlistComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Home::class);

Route::get('/shop', Shop::class);

Route::get('/cart', CartComponent::class)->name('product.cart');

Route::get('/checkout', Checkout::class)->name('checkout');

Route::get('/product/{slug}', ProductDetails::class)->name('product.details');

Route::get('/product-category/{category_slug}', CategoryComponent::class)->name('product.category');

Route::get('/search', SearchResultComponent::class)->name('product.search');

Route::get('/wishlist', WishlistComponent::class)->name('product.wishlist');

Route::get('/thank-you', ThankyouComponent::class)->name('thankyou');

Route::get('/contact-us', ContactComponent::class)->name('contact');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//route for User or Customer
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/user/dashboard', UserDashboard::class)->name('user.dashboard');

    Route::get('/user/orders', UserOrdersComponent::class)->name('user.orders');
    Route::get('/user/orders/{order_id}', UserOrderDetailsComponent::class)->name('user.orderdetails');
    
    Route::get('/user/review/{order_item_id}', UserReviewComponent::class)->name('user.reivew');

    Route::get('user/change-password', UserChangePasswordComponent::class)->name('user.changepassword');
    
});

//route for Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {

    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');

    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AddCategoryComponent::class)->name('admin.addcategory');
    Route::get('/admin/category/edit/{category_slug}', EditCategoryComponent::class)->name('admin.editcategory');

    Route::get('/admin/products', AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/product/add', AddProductComponent::class)->name('admin.addproduct');
    Route::get('/admin/product/edit/{product_slug}', EditProductComponent::class)->name('admin.editproduct');

    Route::get('/admin/slider', AdminHomeSilderComponent::class)->name('admin.homeslider');
    Route::get('/admin/slider/add', AddHomeSiliderComponent::class)->name('admin.addhomeslider');
    Route::get('/admin/slider/edit/{slide_id}', EditHomeSliderComponent::class)->name('admin.edithomeslider');

    Route::get('/admin/home-categories', AdminHomeCategoryComponent::class)->name('admin.homecategories');

    Route::get('/admin/onsale', AdminOnSaleComponent::class)->name('admin.onsale');

    Route::get('/admin/coupons', AdminCouponComponent::class)->name('admin.coupons');
    Route::get('/admin/coupon/add', AdminAddCouponComponent::class)->name('admin.addcoupon');
    Route::get('/admin/coupon/edit/{coupon_id}', AdminEditCouponComponent::class)->name('admin.editcoupon');

    Route::get('/admin/orders', AdminOrderComponent::class)->name('admin.orders');
    Route::get('/admin/order/{order_id}', AdminOrderDetailsComponent::class)->name('admin.orderdetails');

    Route::get('/admin/contact-us', AdminContactComponent::class)->name('admin.contact');
});
