<?php

namespace App\Http\Controllers\Panel;

use App\BaseProduct;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseProductController extends Controller {
  public function __construct() {
    $this->middleware('auth:admin');
  }

  public function index() {
    $views = BaseProductView::all();

    return view('panel.views', [ 'views' => $views ]);
  }

  public function store(Request $request) {
    $files = $request->file('images');

    foreach ($files as $file) {
      $view = new BaseProductView;
      $view->base_product_id = 1;
      $view->zone_width = 40;
      $view->zone_height = 60;
      $view->zone_left = 30.5;
      $view->zone_top = 20;
      $view->name = uniqid() . '_' . trim($file->getClientOriginalName());
      $view->addMedia($file)->toMediaCollection('product');
      $view->save();
    }

    return redirect(route('panel.views'));
  }

  public function remove($id) {
    BaseProductView::findOrFail($id)->delete();

    return redirect(route('panel.views'));
  }

  public function rename($id, Request $request) {
    BaseProductView::findOrFail($id)->update([ 'name' => $request->name ]);

    return redirect(route('panel.views'));
  }
}
