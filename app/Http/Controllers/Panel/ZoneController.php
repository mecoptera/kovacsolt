<?php

namespace App\Http\Controllers\Panel;

use App\Zone;
use App\View;
use App\BaseProductView;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ZoneController extends Controller {
  public function __construct() {
    $this->middleware('auth:admin');
  }

  public function index() {
    $zones = Zone::all()->sortByDesc('created_at');

    return view('panel.zones', [ 'zones' => $zones ]);
  }

  public function edit($id = false) {
    $zone = $id !== false ? Zone::find($id) : false;
    $views = View::all()->sortByDesc('created_at');
    $baseProductViews = BaseProductView::all()->sortByDesc('created_at');

    return view('panel.zone-edit', [
      'zone' => $zone,
      'views' => $views,
      'baseProductViews' => $baseProductViews
    ]);
  }

  public function update($id = false, Request $request) {
    if ($id === false) {
      $zone = new Zone;
      $zone->name = $request->name;
      $zone->view_id = $request->view_id;
      $zone->width = $request->width;
      $zone->height = $request->height;
      $zone->left = $request->left;
      $zone->top = $request->top;
      $zone->save();
      $id = $zone->id;
    } else {
      Zone::where('id', $id)->update([
        'name' => $request->name,
        'view_id' => $request->view_id,
        'width' => $request->width,
        'height' => $request->height,
        'left' => $request->left,
        'top' => $request->top
      ]);
    }

    return redirect(route('panel.zones.edit', [ 'id' => $id ]));
  }

  public function remove($id) {
    Zone::findOrFail($id)->delete();

    return redirect(route('panel.zones'));
  }

  public function ajaxGet() {

  }
}
