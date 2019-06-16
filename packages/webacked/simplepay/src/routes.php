<?php
Route::get('add/{a}/{b}', 'Webacked\SimplePay\SimplePayController@add');
Route::get('pay', 'Webacked\SimplePay\SimplePayController@pay');
