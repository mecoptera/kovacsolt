<?php

namespace App\Http\Controllers\Panel;

use App\BaseProductView;
use App\BaseProduct;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseProductViewController extends Controller {
  public function __construct() {
    $this->middleware('auth:admin');
  }

  public function index() {
    $baseProducts = BaseProduct::all();
    $views = BaseProductView::all();

    return view('panel.baseproductviews', [
      'views' => $views,
      'baseProducts' => $baseProducts
    ]);
  }

  public function store(Request $request) {
    $files = $request->file('images');

    foreach ($files as $file) {
      $view = new BaseProductView;
      $view->base_product_id = $request->base_product_id;
      $view->zone_width = 40;
      $view->zone_height = 60;
      $view->zone_left = 30.5;
      $view->zone_top = 20;
      $view->name = $request->name !== '' ? $request->name : uniqid() . '_' . trim($file->getClientOriginalName());
      $view->addMedia($file)->toMediaCollection('product');
      $view->save();
    }

    return redirect(route('panel.baseproductviews'));
  }

  public function remove($id) {
    BaseProductView::findOrFail($id)->delete();

    return redirect(route('panel.baseproductviews'));
  }

  public function default($id) {
    BaseProductView::where('id', $id)->update([ 'default' => true ]);

    return redirect(route('panel.baseproductviews'));
  }

  public function rename($id, Request $request) {
    BaseProductView::where('id', $id)->update([ 'name' => $request->name ]);

    return redirect(route('panel.baseproductviews'));
  }
}
