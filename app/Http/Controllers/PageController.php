<?php

namespace App\Http\Controllers;

use Auth;
use App\BaseProduct;
use App\BaseProductVariant;
use App\BaseProductView;
use App\BaseProductColor;
use App\Product;
use App\ProductVariant;
use App\Design;
use Webacked\Cart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller {
  public function index() {
    $products = Product::all()->where('is_public', true)->where('show_on_welcome', true);

    return view('page.welcome', [ 'products' => $products ]);
  }

  public function products() {
    $products = Product::all()->where('is_public', true);

    return view('page.products', [ 'products' => $products ]);
  }

  public function product($id) {
    $product = Product::find($id);

    if ($product->admin_id === NULL) {
      return redirect(route('page.welcome'));
    }

    return view('page.product', [ 'product' => $product ]);
  }

  public function step1() {
    $baseProducts = BaseProduct::all();

    return view('page.planner-step1', [ 'baseProducts' => $baseProducts ]);
  }

  public function step2($baseProductId) {
    $baseProduct = BaseProduct::find($baseProductId);
    $baseProductViews = BaseProductView::all()->where('base_product_id', $baseProductId);
    $baseProductColors = BaseProductColor::all()->where('base_product_id', $baseProductId);

    if (Auth::guard('web')->check()) {
      $userProducts = Product::all()->where('user_id', Auth::guard('web')->user()->id);
    } else {
      $userProducts = false;
    }

    return view('page.planner-step2', [
      'baseProduct' => $baseProduct,
      'baseProductViews' => $baseProductViews,
      'baseProductColors' => $baseProductColors,
      'userProducts' => $userProducts
    ]);
  }

  public function step2Area($area) {
    return response()->json($this->{'area' . ucfirst($area)}(), 200);
  }

  public function step2BaseProductVariant(Request $request) {
    $baseProductVariant = BaseProductVariant::where('base_product_id', $request->get('base_product_id'))
      ->where('base_product_view_id', $request->get('base_product_view_id'))
      ->where('base_product_color_id', $request->get('base_product_color_id'))
      ->first();

    return response()->json([
      'baseProductVariantImage' => $baseProductVariant->image['planner'],
      'zoneWidth' => $baseProductVariant->base_product_zone->width,
      'zoneHeight' => $baseProductVariant->base_product_zone->height,
      'zoneLeft' => $baseProductVariant->base_product_zone->left,
      'zoneTop' => $baseProductVariant->base_product_zone->top
    ], 200);
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

    $baseProductVariant = BaseProductVariant::find($postData['base_product_variant_id']);

    $product = new Product;
    $product->base_product_id = $baseProductVariant->base_product_id;
    $product->user_id = Auth::guard('web')->check() ? Auth::guard('web')->user()->id : null;
    $product->name = $postData['name'];
    $product->price = 4990;
    $product->show_on_welcome = 0;
    $product->save();

    $productVariant = new ProductVariant;
    $productVariant->product_id = $product->id;
    $productVariant->base_product_variant_id = $postData['base_product_variant_id'];
    $productVariant->design_id = $postData['design'][0]['id'];
    $productVariant->design_width = $postData['design'][0]['width'];
    $productVariant->design_left = $postData['design'][0]['left'];
    $productVariant->design_top = $postData['design'][0]['top'];
    $productVariant->default = 1;
    $productVariant->save();

    $design = Design::find($postData['design'][0]['id']);
    $design->temporary = 0;
    $design->save();

    Cart::add($product->id, $postData['extra_data']);

    return response()->json([ 'status' => 'success', 'redirect' => route('cart') ], 200);
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
