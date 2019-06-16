<?php

namespace App\Http\Controllers;

use App\Pattern;
use Webacked\Cart\Facades\Cart;
use Illuminate\Http\Request;

class PageController extends Controller {
    public function index() {
        Cart::add('24343243');
        Cart::add('2434324');
        dd(Cart::get());
        return view('page.welcome');
    }

    public function catalog() {
        $patterns = Pattern::all();

        return view('page.catalog', [ 'patterns' => $patterns ]);
    }
}
