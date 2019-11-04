<?php

namespace App\Http\Controllers\Panel;

use App\BaseProduct;
use App\BaseProductView;
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

  public function store(Request $request) {
    $view = new BaseProduct;
    $view->name = $request->name !== '' ? $request->name : uniqid();
    $view->variants = '';
    $view->save();

    return redirect(route('panel.baseproducts'));
  }

  public function remove($id) {
    BaseProduct::where('id', $id)->delete();

    return redirect(route('panel.baseproducts'));
  }

  public function rename($id, Request $request) {
    BaseProduct::where('id', $id)->update([ 'name' => $request->name ]);

    return redirect(route('panel.baseproducts'));
  }
}
