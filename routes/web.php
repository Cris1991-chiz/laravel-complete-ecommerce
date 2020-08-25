<?php

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ShopController@index')->name('home.index');

Route::get('/product/{product}', 'ProductController@show')->name('product.show');

Route::patch('/product/{id}/{qty}', 'ProductController@update')->name('product.update');

Route::get('/cart', 'CartController@index')->name('cart.index');

Route::get('/cart/{product}', 'CartController@addtocart')->name('cart.addtocart');

Route::patch('/cart/{rowId}', 'CartController@update')->name('cart.update');

Route::delete('/cart/{rowId}', 'CartController@destroy')->name('cart.destroy');

Route::delete('/cart', 'CartController@clearCart')->name('cart.clear');

Route::post('/cart/wishlist/{product}', 'CartController@addToWishlist')->name('cart.addToWishlist');

Route::get('/wishlist', 'WishlistController@index')->name('wishlist.index');

Route::post('/wishlist/{rowId}', 'WishlistController@itemMoveToCart')->name('wishlist.itemMoveToCart');

Route::delete('/wishlist/{rowId}', 'WishlistController@destroy')->name('wishlist.destroy');

Route::post('/coupons', 'CouponsController@store')->name('coupon.store');

Route::delete('/coupons', 'CouponsController@destroy')->name('coupon.destroy');

Route::get('/checkout/personalinfo', 'BillingController@getBillingAdd')->name('personalinfo.index');

Route::post('/checkout/billinginfo', 'CheckoutController@storeBillingAdd')->name('billing.store');

Route::post('/checkout/personalinfo', 'BillingController@storeShippingAdd')->name('shipping.store');

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');

Route::get('/checkout/{id}', 'CheckoutController@selectBillingAdd')->name('billing.select');

Route::get('/checkout/personalinfo/{id}', 'CheckoutController@checkShippingAdd')->name('shipping.check');

Route::get('/checkout/personalinfo/shipping/{id}', 'CheckoutController@uncheckShippingAdd')->name('shipping.uncheck');

Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');

Route::get('/checkoutguest', 'CheckoutController@index')->name('guest.index');

Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

Route::get('/myaccount/edit', 'UserController@edit')->name('account.edit')->middleware('auth');;

Route::post('/myaccount/update', 'UserController@update')->name('account.update');

Route::get('/myaccount/fetchdata/{id}', 'UserController@fetchData')->name('account.fetchData');

Route::post('/myaccount/update/billing', 'UserController@updateBilling')->name('account.updateBilling');

Route::get('/myaccount/logout', 'UserController@logout')->name('account.logout');

Route::middleware('auth')->group(function () {
    Route::get('/my-orders', 'OrdersController@index')->name('orders.index');
    Route::get('/my-orders/{order}', 'OrdersController@show')->name('orders.show');
});

Auth::routes();

// Route::get('/user-bill-add', function() {
//     return View::make('partials.modal.billing-address');
// });

Route::get('/home', 'HomeController@index')->name('home');


