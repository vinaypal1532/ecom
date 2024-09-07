<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChallanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\OfferController;

use App\Http\Controllers\frontend\MainController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\ProfileController;
use App\Http\Controllers\frontend\AddressController;
use App\Http\Controllers\frontend\SubscriptionController;

use App\Http\Controllers\frontend\ReviewController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/employee-dashboard', [App\Http\Controllers\HomeController::class, 'teacher_index'])->name('employee-dashboard');
Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');


Route::group(['middleware' => ['auth', 'user-access']], function () {
   
    Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
 
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

;



 Route::get('profile', [HomeController::class, 'profile'])->name('profile');

 Route::put('/profile/update', [HomeController::class, 'update'])->name('update-profile');


 Route::get('client', [ClientController::class, 'index'])->name('client.index');
 Route::get('user', [UserController::class, 'get_user'])->name('user.index');
 Route::get('user/{id}', [UserController::class, 'show'])->name('user.show');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');
Route::get('subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
Route::post('subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');
Route::get('subcategories/{subCategory}', [SubCategoryController::class, 'show'])->name('subcategories.show');
Route::get('subcategories/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
Route::put('subcategories/{subCategory}', [SubCategoryController::class, 'update'])->name('subcategories.update');
Route::delete('subcategories/{subCategory}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('banner', [BannerController::class, 'index'])->name('banner');
Route::get('add_banner', [BannerController::class, 'create'])->name('add_banner');
Route::post('add_bannerData', [BannerController::class, 'store'])->name('add_bannerData');
Route::get('banner_edit/{id}', [BannerController::class, 'edit'])->name('banner_edit');
Route::put('updateBanner/{id}', [BannerController::class, 'update'])->name('updateBanner');
Route::get('banner_delete/{id}', [BannerController::class, 'destroy'])->name('banner_delete');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/invoice/{order_id}', [OrderController::class, 'show_invoice'])->name('invoice.show');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');

Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

Route::get('settings', [SettingController::class, 'index'])->name('settings');
Route::put('settings', [SettingController::class, 'update'])->name('update-profile');


Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonial');
Route::get('add_testi', [TestimonialController::class, 'create'])->name('add_testi');
Route::post('testimonials/store', [TestimonialController::class, 'store'])->name('testimonials.store');
Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');



Route::get('offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('offers/create', [OfferController::class, 'create'])->name('offers.create');
Route::post('offers/store', [OfferController::class, 'store'])->name('offers.store');
Route::delete('offers/{offer}', [OfferController::class, 'destroy'])->name('offers.destroy');
Route::get('/offers/{offer}/edit', [OfferController::class, 'edit'])->name('offers.edit');
Route::put('/offers/{offer}', [OfferController::class, 'update'])->name('offers.update');

});

Route::get('/empty-cart', function () {
    return view('frontend.empty-cart');
})->name('empty-cart');

Route::get('/contact', [MainController::class, 'contact'])->name('contact');

Route::get('/product', [MainController::class, 'product'])->name('product');
Route::get('/product-detail/{id}', [MainController::class, 'product_detail'])->name('product-detail');

Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/term-condition', [MainController::class, 'term'])->name('term-condition');
Route::get('/privacy-policy', [MainController::class, 'privacy'])->name('privacy-policy');
Route::get('/faq', [MainController::class, 'faq'])->name('faq');
Route::get('/return-policy', [MainController::class, 'return'])->name('return-policy');
Route::post('/insert-data', [MainController::class, 'store'])->name('insert-data');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart-count', [CartController::class, 'cartCount'])->name('cart.count');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('/user-profile', [ProfileController::class, 'index'])->name('user-profile.index');
Route::post('/address', [AddressController::class, 'store'])->name('address.store');
Route::put('/update', [AddressController::class, 'updateAddress'])->name('address.update');
Route::delete('/addresses/{id}', [AddressController::class, 'destroy']);

// routes/web.php
Route::post('/checkout/process', [CartController::class, 'process'])->name('checkout.process');
// In web.php
Route::get('/thankyou', function () {
    return view('frontend.thankyou');
})->name('thankyou');

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('invoicess/{id}', [ProfileController::class, 'download_invoice'])->name('invoicess');
Route::get('cancel/{id}', [CartController::class, 'order_cancel'])->name('cancel');
Route::get('customer', [MainController::class, 'showLoginForm'])->name('customer');
Route::get('customerregister', [MainController::class, 'showRegistrationForm'])->name('customerregister');

Route::post('/products/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Auth::routes();

