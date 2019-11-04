<?php

namespace App\Http\Controllers\Panel;

use App\Design;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DesignController extends Controller {
  public function __construct() {
    $this->middleware('auth:admin');
  }

  public function index() {
    $designs = Design::all();

    return view('panel.designs', [ 'designs' => $designs ]);
  }

  public function store(Request $request) {
    $files = $request->file('images');

    foreach ($files as $file) {
      $design = new Design;
      $design->name = $request->name !== '' ? $request->name : uniqid() . '_' . trim($file->getClientOriginalName());
      $design->addMedia($file)->toMediaCollection('design');
      $design->save();
    }

    return redirect(route('panel.designs'));
  }

  public function remove($id) {
    Design::where('id', $id)->delete();

    return redirect(route('panel.designs'));
  }

  public function rename($id, Request $request) {
    Design::where('id', $id)->update([ 'name' => $request->name ]);

    return redirect(route('panel.designs'));
  }
}
