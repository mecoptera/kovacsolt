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
      'alias' => $request->alias
    ]);

    return redirect(route('panel.views.edit', [ 'id' => $id ]));
  }

  public function remove($id) {
    View::findOrFail($id)->delete();

    return redirect(route('panel.views'));
  }
}
