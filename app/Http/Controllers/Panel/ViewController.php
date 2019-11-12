<?php

namespace App\Http\Controllers\Panel;

use App\View;
use App\BaseProduct;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ViewController extends Controller {
  public function __construct() {
    $this->middleware('auth:admin');
  }

  public function index() {
    $views = View::all()->sortByDesc('created_at');

    return view('panel.views', [ 'views' => $views ]);
  }

  public function create(Request $request) {
    $view = new View;
    $view->zone_width = 40;
    $view->zone_height = 60;
    $view->zone_left = 30.5;
    $view->zone_top = 20;
    $view->name = $request->name;
    $view->alias = $request->alias;
    $view->save();

    return redirect(route('panel.views'));
  }

  public function edit($id) {
    $view = View::find($id);

    return view('panel.view-edit', [ 'view' => $view ]);
  }

  public function update($id, Request $request) {
    View::where('id', $id)->update([
      'name' => $request->name,
      'alias' => $request->alias,
      'zone_width' => $request->zone_width,
      'zone_height' => $request->zone_height,
      'zone_left' => $request->zone_left,
      'zone_top' => $request->zone_top
    ]);

    return redirect(route('panel.views.edit', [ 'id' => $id ]));
  }

  public function remove($id) {
    View::findOrFail($id)->delete();

    return redirect(route('panel.views'));
  }
}
