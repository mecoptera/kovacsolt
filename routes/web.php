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

Route::get('/planner', 'PageController@step1')->name('page.planner.step1');
Route::get('/planner/{product}', 'PageController@step2')->name('page.planner.step2');
Route::get('/planner/area/{area?}', 'PageController@step2Area')->name('page.planner.area');
Route::get('/planner/finalize', 'PageController@step3')->name('page.planner.step3');

Route::get('/contact', 'PageController@contact')->name('page.contact');
Route::get('/about', 'PageController@about')->name('page.about');
Route::get('/privacy', 'PageController@privacy')->name('page.privacy');

Auth::routes(['verify' => true]);
Route::get('/user', 'UserController@index')->middleware('verified')->name('user');
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

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
});
