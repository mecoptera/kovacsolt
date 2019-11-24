<?php

namespace App\Http\Controllers\Panel;

use App\BaseProduct;
use App\BaseProductVariant;
use App\BaseProductView;
use App\BaseProductColor;
use App\BaseProductZone;
use App\View;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseProductController extends Controller {
  public function __construct() {
    $this->middleware('auth:admin');
  }

  public function index() {
    $baseProducts = BaseProduct::all();

    return view('panel.baseproducts', [ 'baseProducts' => $baseProducts ]);
  }

  public function create(Request $request) {
    $baseProduct = new BaseProduct;
    $baseProduct->name = $request->name;
    $baseProduct->save();

    return redirect(route('panel.baseproducts'));
  }

  public function edit($id) {
    $baseProduct = BaseProduct::find($id);
    $baseProductColors = BaseProductColor::where('base_product_id', $id)->get()->sortByDesc('created_at');
    $baseProductViews = BaseProductView::where('base_product_id', $id)->get()->sortByDesc('created_at');
    $baseProductVariants = BaseProductVariant::where('base_product_id', $id)->get()->sortByDesc('created_at');
    $baseProductZones = BaseProductZone::where('base_product_id', $id)->get()->sortByDesc('created_at');

    return view('panel.baseproduct-edit', [
      'baseProduct' => $baseProduct,
      'baseProductVariants' => $baseProductVariants,
      'baseProductViews' => $baseProductViews,
      'baseProductColors' => $baseProductColors,
      'baseProductZones' => $baseProductZones
    ]);
  }

  public function update($id, Request $request) {
    BaseProduct::where('id', $id)->update([ 'name' => $request->name ]);

    return redirect(route('panel.baseproducts.edit', [ 'id' => $id ]));
  }

  public function remove($id) {
    BaseProduct::where('id', $id)->delete();

    return redirect(route('panel.baseproducts'));
  }

  public function addColor($id, Request $request) {
    $baseProductColor = new BaseProductColor;
    $baseProductColor->base_product_id = $id;
    $baseProductColor->name = $request->name;
    $baseProductColor->value = $request->value;
    $baseProductColor->save();

    return redirect(route('panel.baseproducts.edit', [ 'id' => $id ]));
  }

  public function editColor($id) {
    $baseProductColor = BaseProductColor::find($id);
    return view('panel.baseproductcolor-edit', [ 'baseProductColor' => $baseProductColor ]);
  }

  public function updateColor($id, Request $request) {
    $baseProductColor = BaseProductColor::find($id);

    BaseProductColor::where('id', $id)->update([
      'name' => $request->name,
      'value' => $request->value
    ]);

    return redirect(route('panel.baseproducts.edit', [ 'id' => $baseProductColor->base_product_id ]));
  }

  public function removeColor($id) {
    $baseProductColor = BaseProductColor::find($id);

    BaseProductColor::where('id', $id)->delete();

    return redirect(route('panel.baseproducts.edit', [ 'id' => $baseProductColor->base_product_id ]));
  }

  public function addView($id, Request $request) {
    $baseProductView = new BaseProductView;
    $baseProductView->base_product_id = $id;
    $baseProductView->name = $request->name;
    $baseProductView->save();

    return redirect(route('panel.baseproducts.edit', [ 'id' => $id ]));
  }

  public function editView($id) {
    $baseProductView = BaseProductView::find($id);
    return view('panel.baseproductview-edit', [ 'baseProductView' => $baseProductView ]);
  }

  public function updateView($id, Request $request) {
    $baseProductView = BaseProductView::find($id);

    BaseProductView::where('id', $id)->update([ 'name' => $request->name ]);

    return redirect(route('panel.baseproducts.edit', [ 'id' => $baseProductView->base_product_id ]));
  }

  public function removeView($id) {
    $baseProductView = BaseProductView::find($id);

    BaseProductView::where('id', $id)->delete();

    return redirect(route('panel.baseproducts.edit', [ 'id' => $baseProductView->base_product_id ]));
  }

  public function addVariant($id, Request $request) {
    $file = $request->file('image');
    $filename = md5(uniqid() . time()) . '.' . $request->file('image')->getClientOriginalExtension();

    $baseProductVariant = new BaseProductVariant;
    $baseProductVariant->base_product_id = $id;
    $baseProductVariant->base_product_color_id = $request->color;
    $baseProductVariant->base_product_view_id = $request->view;
    $baseProductVariant->base_product_zone_id = $request->zone;
    $baseProductVariant->addMedia($file)->usingFileName($filename)->toMediaCollection('base_product_variant');
    $baseProductVariant->save();

    return redirect(route('panel.baseproducts.edit', [ 'id' => $id ]));
  }

  public function editVariant($id) {
    $baseProductVariant = BaseProductVariant::find($id);
    $baseProductColors = BaseProductColor::where('base_product_id', $baseProductVariant->base_product_id)->get()->sortByDesc('created_at');
    $baseProductViews = BaseProductView::where('base_product_id', $baseProductVariant->base_product_id)->get()->sortByDesc('created_at');
    $baseProductZones = BaseProductZone::where('base_product_id', $baseProductVariant->base_product_id)->get()->sortByDesc('created_at');

    return view('panel.baseproductvariant-edit', [
      'baseProductVariant' => $baseProductVariant,
      'baseProductColors' => $baseProductColors,
      'baseProductViews' => $baseProductViews,
      'baseProductZones' => $baseProductZones
    ]);
  }

  public function updateVariant($id, Request $request) {
    $baseProductVariant = BaseProductVariant::find($id);

    $file = $request->file('image');

    if ($file) {
      $filename = md5(uniqid() . time()) . '.' . $request->file('image')->getClientOriginalExtension();
      $baseProductVariant->addMedia($file)->usingFileName($filename)->toMediaCollection('base_product_variant');
    }

    BaseProductVariant::where('id', $id)->update([
      'base_product_color_id' => $request->color,
      'base_product_view_id' => $request->view,
      'base_product_zone_id' => $request->zone
    ]);

    return redirect(route('panel.baseproducts.edit', [ 'id' => $baseProductVariant->base_product_id ]));
  }

  public function removeVariant($id) {
    $baseProductVariant = BaseProductVariant::find($id);

    BaseProductVariant::where('id', $id)->delete();

    return redirect(route('panel.baseproducts.edit', [ 'id' => $baseProductVariant->base_product_id ]));
  }

  public function addZone($id, Request $request) {
    $baseProductZone = new BaseProductZone;
    $baseProductZone->base_product_id = $id;
    $baseProductZone->name = $request->name;
    $baseProductZone->save();

    return redirect(route('panel.baseproductzones.edit', [ 'id' => $baseProductZone->id ]));
  }

  public function editZone($id) {
    $baseProductZone = BaseProductZone::find($id);
    $baseProductVariants = BaseProductVariant::where('base_product_id', $baseProductZone->base_product_id)->get()->sortByDesc('created_at');

    return view('panel.baseproductzone-edit', [
      'baseProductZone' => $baseProductZone,
      'baseProductVariants' => $baseProductVariants
    ]);
  }

  public function updateZone($id, Request $request) {
    $baseProductZone = BaseProductZone::find($id);

    BaseProductZone::where('id', $id)->update([
      'name' => $request->name,
      'width' => $request->width,
      'height' => $request->height,
      'left' => $request->left,
      'top' => $request->top
    ]);

    foreach ($request->variant_id as $variant) {
      BaseProductVariant::where('id', $variant)->update([ 'base_product_zone_id' => $id ]);
    }

    return redirect(route('panel.baseproducts.edit', [ 'id' => $baseProductZone->base_product_id ]));
  }

  public function removeZone($id) {
    $baseProductZone = BaseProductZone::find($id);

    BaseProductZone::where('id', $id)->delete();

    return redirect(route('panel.baseproducts.edit', [ 'id' => $baseProductView->base_product_id ]));
  }
}
