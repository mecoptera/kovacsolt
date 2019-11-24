<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Auth;
use Webacked\Cart\Facades\Cart;

class LoginController extends Controller {
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct() {
      $this->middleware('guest')->except('logout', 'userLogout');
    }

    public function userLogout() {
      Auth::guard('web')->logout();
      Session::flush('cart');
      return redirect('/');
    }

    protected function authenticated(Request $request, $user) {
      Cart::init();

      if ($request->has('from')) {
        return redirect()->route($request->get('from'));
      }
    }
}
