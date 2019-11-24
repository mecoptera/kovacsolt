<?php

namespace App\Http\Controllers\Panel;

use Auth;
use App\Product;
use App\ProductVariant;
use App\BaseProduct;
use App\BaseProductVariant;
use App\Design;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller {
  public function __construct() {
    $this->middleware('auth:admin');
  }

  public function index() {
    $products = Product::all()->where('admin_id', '<>', NULL);
    $baseProducts = BaseProduct::all();

    return view('panel.products', [
      'products' => $products,
      'baseProducts' => $baseProducts
    ]);
  }

  public function create(Request $request) {
    $product = new Product;
    $product->admin_id = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : null;
    $product->base_product_id = $request->base_product;
    $product->name = $request->name;
    $product->save();

    return redirect(route('panel.products.edit', [ 'id' => $product->id ]));
  }

  public function edit($id) {
    $product = Product::find($id);
    $productVariants = ProductVariant::all()->where('product_id', $id);
    $baseProducts = BaseProduct::all();
    $baseProductVariants = BaseProductVariant::all()->where('base_product_id', $product->base_product_id);
    $designs = Design::all()->where('user_id', NULL);

    return view('panel.product-edit', [
      'product' => $product,
      'baseProducts' => $baseProducts,
      'productVariants' => $productVariants,
      'baseProductVariants' => $baseProductVariants,
      'designs' => $designs
    ]);
  }

  public function update($id, Request $request) {
    Product::where('id', $id)->update([
      'name' => $request->name,
      'base_product_id' => $request->base_product,
      'price' => $request->price,
      'show_on_welcome' => $request->show_on_welcome === 'on',
      'is_public' => $request->is_public === 'on'
    ]);

    return redirect(route('panel.products.edit', [ 'id' => $id ]));
  }

  public function remove($id) {
    Product::where('id', $id)->delete();

    return redirect(route('panel.products'));
  }

  public function addVariant($id, Request $request) {
    $productVariant = new ProductVariant;
    $productVariant->product_id = $id;
    $productVariant->base_product_variant_id = $request->base_product_variant;
    $productVariant->design_id = $request->design;
    $productVariant->save();

    return redirect(route('panel.productvariants.edit', [ 'id' => $productVariant->id ]));
  }

  public function editVariant($id) {
    $productVariant = ProductVariant::find($id);

    return view('panel.productvariant-edit', [
      'productVariant' => $productVariant
    ]);
  }

  public function updateVariant($id, Request $request) {
    $productVariant = ProductVariant::find($id);

    ProductVariant::where('id', $id)->update([
      'design_width' => $request->width,
      'design_left' => $request->left,
      'design_top' => $request->top
    ]);

    return redirect(route('panel.products.edit', [ 'id' => $productVariant->product_id ]));
  }

  public function removeVariant($id) {
    $productVariant = ProductVariant::find($id);
    ProductVariant::where('id', $id)->delete();

    return redirect(route('panel.products.edit', [ 'id' => $productVariant->product_id ]));
  }
}
