<?php

Route::group(['middleware' => 'web'], function () {
  Route::get('cart', 'Webacked\Cart\CartController@index')->name('cart');
  Route::get('cart/list', 'Webacked\Cart\CartController@list')->name('cart.list');
  Route::post('cart/add', 'Webacked\Cart\CartController@add')->name('cart.add');
  Route::get('cart/empty', 'Webacked\Cart\CartController@empty')->name('cart.empty');
});
