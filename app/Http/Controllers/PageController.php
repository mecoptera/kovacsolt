<?php

namespace App\Http\Controllers;

use App\Product;
use App\Design;
use Webacked\Cart\Facades\Cart;
use Illuminate\Http\Request;

class PageController extends Controller {
  public function index() {
    $products = Product::all()->where('show_on_welcome', true);

    return view('page.welcome', [ 'products' => $products ]);
  }

  public function products() {
    $products = Product::all();

    return view('page.products', [ 'products' => $products ]);
  }

  public function step1() {
    return view('page.planner-step1');
  }

  public function step2($product) {
    return view('page.planner-step2', [ 'defaultProduct' => $product ]);
  }

  public function step2Area($area) {
    return response()->json($this->{'area' . ucfirst($area)}(), 200);
  }

  public function step3() {
    return view('page.planner-step3');
  }

  private function areaDesigns() {
    $designs = Design::all();

    return [
      'content' => view('page.areas.designs', [ 'designs' => $designs ])->render()
    ];
  }

  public function contact() {
    return view('page.contact');
  }

  public function privacy() {
    return view('page.privacy');
  }

  public function sandbox($page) {
    return view('sandbox.' . $page);
  }
}
