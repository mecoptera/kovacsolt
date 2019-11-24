<?php

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

Route::get('/', 'PageController@index')->name('page.welcome');
Route::get('/products', 'PageController@products')->name('page.products');
Route::get('/product/{id}', 'PageController@product')->name('page.product');

Route::get('/planner', 'PageController@step1')->name('page.planner.step1');
Route::get('/planner/{baseProduct}', 'PageController@step2')->name('page.planner.step2');
Route::get('/planner/area/{area?}', 'PageController@step2Area')->name('page.planner.area');
Route::post('/planner/baseproduct', 'PageController@step2BaseProductVariant')->name('page.planner.baseproductvariant');
Route::post('/planner/save', 'PageController@save')->name('page.planner.save');
Route::post('/planner/upload', 'PageController@upload')->name('page.planner.upload');

Route::get('/contact', 'PageController@contact')->name('page.contact');
Route::get('/about', 'PageController@about')->name('page.about');
Route::get('/privacy', 'PageController@privacy')->name('page.privacy');

Auth::routes(['verify' => true]);

Route::prefix('user')->group(function() {
  Route::get('/profile', 'UserController@index')->middleware('verified')->name('user.profile');
  Route::post('/profile', 'UserController@saveProfile')->middleware('verified')->name('user.profile.save');
  Route::get('/login', 'Auth\LoginController@showLoginForm')->name('user.login');
  Route::post('/login', 'Auth\LoginController@login')->name('user.login');
  Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('user.register');
  Route::post('/register', 'Auth\RegisterController@register')->name('user.register');
  Route::get('/register/activate', 'UserController@activate')->name('user.register.activate');
  Route::get('/email/resend', 'Auth\VerificationController@resend')->name('user.verification.resend');
  Route::get('/email/verify', 'Auth\VerificationController@show')->name('user.verification.notice');
  Route::get('/email/verify/{id}', 'Auth\VerificationController@verify')->name('user.verification.verify');
  Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');
  Route::get('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
});

Route::prefix('order')->group(function() {
  Route::get('/profile', 'OrderController@profile')->middleware([ 'checkCart' ])->name('order.profile');
  Route::get('/billing', 'OrderController@billing')->middleware([ 'checkCart' ])->name('order.billing');
  Route::post('/billing', 'OrderController@billingPost')->middleware([ 'checkCart' ])->name('order.billing');
  Route::get('/shipping', 'OrderController@shipping')->middleware([ 'checkCart' ])->name('order.shipping');
  Route::post('/shipping', 'OrderController@shippingPost')->middleware([ 'checkCart' ])->name('order.shipping');
  Route::get('/payment', 'OrderController@payment')->middleware([ 'checkCart' ])->name('order.payment');
  Route::post('/payment', 'OrderController@paymentPost')->middleware([ 'checkCart' ])->name('order.payment');
  Route::get('/finalize', 'OrderController@finalize')->middleware([ 'checkCart' ])->name('order.finalize');
  Route::post('/finalize', 'OrderController@finalizePost')->middleware([ 'checkCart' ])->name('order.finalize');
  Route::get('/success', 'OrderController@success')->name('order.success');
  Route::get('/error', 'OrderController@error')->name('order.error');
});

Route::prefix('panel')->group(function() {
  // Route::get('/email/resend', 'Auth\PanelVerificationController@resend')->name('panel.verification.resend');
  // Route::get('/email/verify', 'Auth\PanelVerificationController@show')->name('panel.verification.notice');
  // Route::get('/email/verify/{id}', 'Auth\PanelVerificationController@verify')->name('panel.verification.verify');
  Route::get('/login', 'Auth\PanelLoginController@showLoginForm')->name('panel.login');
  Route::post('/login', 'Auth\PanelLoginController@login')->name('panel.login.submit');
  Route::post('/password/email', 'Auth\PanelForgotPasswordController@sendResetLinkEmail')->name('panel.password.email');
  Route::get('/password/reset', 'Auth\PanelForgotPasswordController@showLinkRequestForm')->name('panel.password.request');
  Route::post('/password/reset', 'Auth\PanelResetPasswordController@reset')->name('panel.password.update');
  Route::get('/password/reset/{token}', 'Auth\PanelResetPasswordController@showResetForm')->name('panel.password.reset');
  // Route::get('/register', 'Auth\PanelRegisterController@showRegistrationForm')->name('panel.register');
  // Route::post('/register', 'Auth\PanelRegisterController@register');
  Route::get('', 'PanelController@index')->name('panel.dashboard');
  Route::get('/logout', 'Auth\PanelLoginController@logout')->name('panel.logout');

  Route::get('/designs', 'Panel\DesignController@index')->name('panel.designs');
  Route::post('/designs', 'Panel\DesignController@store')->name('panel.designs.upload');
  Route::get('/designs/feature/{id}', 'Panel\DesignController@feature')->name('panel.designs.feature');
  Route::get('/designs/delete/{id}', 'Panel\DesignController@remove')->name('panel.designs.delete');
  Route::post('/designs/rename/{id}', 'Panel\DesignController@rename')->name('panel.designs.rename');

  Route::get('/base-products', 'Panel\BaseProductController@index')->name('panel.baseproducts');
  Route::post('/base-products', 'Panel\BaseProductController@create')->name('panel.baseproducts.create');
  Route::get('/base-products/edit/{id}', 'Panel\BaseProductController@edit')->name('panel.baseproducts.edit');
  Route::post('/base-products/edit/{id}', 'Panel\BaseProductController@update')->name('panel.baseproducts.update');
  Route::get('/base-products/delete/{id}', 'Panel\BaseProductController@remove')->name('panel.baseproducts.delete');

  Route::post('/base-products/color/{id}', 'Panel\BaseProductController@addColor')->name('panel.baseproducts.colors.create');
  Route::get('/base-product-colors/edit/{id}', 'Panel\BaseProductController@editColor')->name('panel.baseproductcolors.edit');
  Route::post('/base-product-colors/edit/{id}', 'Panel\BaseProductController@updateColor')->name('panel.baseproductcolors.update');
  Route::get('/base-product-colors/delete/{id}', 'Panel\BaseProductController@removeColor')->name('panel.baseproductcolors.delete');

  Route::post('/base-products/view/{id}', 'Panel\BaseProductController@addView')->name('panel.baseproducts.views.create');
  Route::get('/base-product-views/edit/{id}', 'Panel\BaseProductController@editView')->name('panel.baseproductviews.edit');
  Route::post('/base-product-views/edit/{id}', 'Panel\BaseProductController@updateView')->name('panel.baseproductviews.update');
  Route::get('/base-product-views/delete/{id}', 'Panel\BaseProductController@removeView')->name('panel.baseproductviews.delete');

  Route::post('/base-products/variant/{id}', 'Panel\BaseProductController@addVariant')->name('panel.baseproducts.variants.create');
  Route::get('/base-product-variants/edit/{id}', 'Panel\BaseProductController@editVariant')->name('panel.baseproductvariants.edit');
  Route::post('/base-product-variants/edit/{id}', 'Panel\BaseProductController@updateVariant')->name('panel.baseproductvariants.update');
  Route::get('/base-product-variants/delete/{id}', 'Panel\BaseProductController@removeVariant')->name('panel.baseproductvariants.delete');

  Route::post('/base-products/zone/{id}', 'Panel\BaseProductController@addZone')->name('panel.baseproducts.zones.create');
  Route::get('/base-product-zones/edit/{id}', 'Panel\BaseProductController@editZone')->name('panel.baseproductzones.edit');
  Route::post('/base-product-zones/edit/{id}', 'Panel\BaseProductController@updateZone')->name('panel.baseproductzones.update');
  Route::get('/base-product-zones/delete/{id}', 'Panel\BaseProductController@removeZone')->name('panel.baseproductzones.delete');

  Route::get('/orders', 'Panel\OrderController@index')->name('panel.orders');
  Route::get('/orders/edit/{id}', 'Panel\OrderController@edit')->name('panel.orders.edit');
  Route::post('/orders/edit/{id}', 'Panel\OrderController@update')->name('panel.orders.update');
  Route::get('/orders/delete/{id}', 'Panel\OrderController@remove')->name('panel.orders.delete');
});

Route::get('/sandbox/{name}', 'PageController@sandbox');
