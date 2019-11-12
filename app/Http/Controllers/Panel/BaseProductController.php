<?php

namespace App\Http\Controllers\Panel;

use App\BaseProduct;
use App\BaseProductView;
use App\BaseProductColor;
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
    $views = View::all()->sortByDesc('created_at');
    $baseProductColors = BaseProductColor::where('base_product_id', $id)->get()->sortByDesc('created_at');
    $baseProductViews = BaseProductView::where('base_product_id', $id)->get()->sortByDesc('created_at');

    return view('panel.baseproduct-edit', [
      'baseProduct' => $baseProduct,
      'views' => $views,
      'colors' => $baseProductColors,
      'baseProductViews' => $baseProductViews
    ]);
  }

  public function update($id, Request $request) {
    BaseProduct::where('id', $id)->update([ 'name' => $request->name ]);

    return redirect(route('panel.baseproducts.edit', [ 'id' => $id ]));
  }

  public function addColor($id, Request $request) {
    $baseProduct = new BaseProductColor;
    $baseProduct->base_product_id = $id;
    $baseProduct->name = $request->name;
    $baseProduct->value = $request->value;
    $baseProduct->save();

    return redirect(route('panel.baseproducts.edit', [ 'id' => $id ]));
  }

  public function addView($id, Request $request) {
    $file = $request->file('image');

    $baseProductView = new BaseProductView;
    $baseProductView->base_product_id = $id;
    $baseProductView->view_id = $request->view;
    $baseProductView->base_product_color_id = $request->color;
    $baseProductView->addMedia($file)->toMediaCollection('base_product_view');
    $baseProductView->save();

    return redirect(route('panel.baseproducts.edit', [ 'id' => $id ]));
  }

  public function remove($id) {
    BaseProduct::where('id', $id)->delete();

    return redirect(route('panel.baseproducts'));
  }
}
