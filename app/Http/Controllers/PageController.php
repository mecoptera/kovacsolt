<?php

namespace App\Http\Controllers;

use Auth;
use App\BaseProduct;
use App\BaseProductView;
use App\BaseProductColor;
use App\Product;
use App\ProductView;
use App\Design;
use Webacked\Cart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller {
  public function index() {
    $products = Product::all()->where('show_on_welcome', true);

    return view('page.welcome', [ 'products' => $products ]);
  }

  public function products() {
    $products = Product::all();

    return view('page.products', [ 'products' => $products ]);
  }

  public function product($id) {
    $product = Product::find($id);

    return view('page.product', [ 'product' => $product ]);
  }

  public function step1() {
    $baseProducts = BaseProduct::all();

    return view('page.planner-step1', [ 'baseProducts' => $baseProducts ]);
  }

  public function step2($baseProductId) {
    $baseProduct = BaseProduct::find($baseProductId);
    $views = BaseProductView::where('base_product_id', $baseProductId)->groupBy('view_id')->get();
    $baseProductColors = BaseProductColor::all()->where('base_product_id', $baseProductId);

    if (Auth::guard('web')->check()) {
      $userProducts = Product::all()->where('user_id', Auth::guard('web')->user()->id);
    } else {
      $userProducts = false;
    }

    return view('page.planner-step2', [
      'baseProduct' => $baseProduct,
      'views' => $views,
      'baseProductColors' => $baseProductColors,
      'userProducts' => $userProducts
    ]);
  }

  public function step2Area($area) {
    return response()->json($this->{'area' . ucfirst($area)}(), 200);
  }

  public function step2BaseProductView(Request $request) {
    $baseProductView = BaseProductView::where('base_product_id', $request->get('base_product_id'))
      ->where('view_id', $request->get('view_id'))
      ->where('base_product_color_id', $request->get('base_product_color_id'))
      ->first();

    return response()->json([ 'baseProductViewImage' => $baseProductView->image['planner'] ], 200);
  }

  public function save(Request $request) {
    $postData = $request->all();

    $validator = Validator::make($postData, [
      'design' => 'required'
    ], [
      'design.required' => 'Nincs kiválasztva minta a termékhez'
    ]);

    if ($validator->fails()) {
      return response()->json([ 'status' => 'error', 'message' => 'Hiba a megadott adatokban!', 'validation' => $validator->errors() ], 200);
    }

    $product = new Product;
    $product->base_product_id = $postData['base_product_id'];
    $product->user_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : null;
    $product->name = $postData['name'];
    $product->extra_data = json_encode($postData['extra_data']);
    $product->price = 4990;
    $product->show_on_welcome = 0;
    $product->save();

    $productView = new ProductView;
    $productView->product_id = $product->id;
    $productView->base_product_view_id = $postData['base_product_view_id'];
    $productView->design_id = $postData['design'][0]['id'];
    $productView->design_width = $postData['design'][0]['width'];
    $productView->design_left = $postData['design'][0]['left'];
    $productView->design_top = $postData['design'][0]['top'];
    $productView->default = 1;
    $productView->save();

    $design = Design::find($postData['design'][0]['id']);
    $design->temporary = 0;
    $design->save();

    return response()->json([ 'status' => 'success', 'redirect' => route('page.welcome') ], 200);
  }

  public function upload(Request $request) {
    if (!Auth::guard('web')->check()) {
      return response()->json([ 'status' => 'error', 'message' => 'User has not logged in!' ], 403);
    }

    $file = $request->file('design');

    $design = new Design;
    $design->name = uniqid() . '_' . md5(uniqid()) . '.' . $file->getClientOriginalExtension();
    $design->user_id = Auth::guard('web')->user()->id;
    $design->temporary = 1;
    $design->addMedia($file)->toMediaCollection('design');
    $design->save();

    return response()->json([
      'id' => $design->id,
      'url' => url($design->getFirstMediaUrl('design', 'planner'))
    ], 200);
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

  public function about() {
    return view('page.about');
  }

  public function privacy() {
    return view('page.privacy');
  }

  public function sandbox($page) {
    return view('sandbox.' . $page);
  }
}
