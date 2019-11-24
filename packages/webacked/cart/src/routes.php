<?php

Route::group(['middleware' => 'web'], function () {
  Route::get('cart', 'Webacked\Cart\CartController@index')->name('cart');
  Route::post('cart', 'Webacked\Cart\CartController@finalize')->name('cart');
  Route::post('cart/add/{productId}', 'Webacked\Cart\CartController@add')->name('cart.add');
  Route::get('cart/empty', 'Webacked\Cart\CartController@empty')->name('cart.empty');
  Route::get('cart/area/{area?}', 'Webacked\Cart\CartController@area')->name('cart.area');
});
