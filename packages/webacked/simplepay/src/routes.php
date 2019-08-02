<?php

Route::group(['middleware' => 'web'], function () {
  Route::get('add/{a}/{b}', 'Webacked\SimplePay\SimplePayController@add');
  Route::get('pay', 'Webacked\SimplePay\SimplePayController@index');
  Route::get('pay/backref', 'Webacked\SimplePay\SimplePayController@backref');
});
