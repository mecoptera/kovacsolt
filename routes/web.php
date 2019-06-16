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
Route::get('/catalog', 'PageController@catalog')->name('page.catalog');

Auth::routes(['verify' => true]);
Route::get('/home', 'UserController@index')->middleware('verified')->name('user.home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

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

    Route::get('/patterns', 'Panel\PatternController@index')->name('panel.patterns');
    Route::post('/patterns', 'Panel\PatternController@store')->name('panel.patterns.upload');
    Route::get('/patterns/delete/{id}', 'Panel\PatternController@remove')->name('panel.patterns.delete');
    Route::post('/patterns/rename/{id}', 'Panel\PatternController@rename')->name('panel.patterns.rename');
});
