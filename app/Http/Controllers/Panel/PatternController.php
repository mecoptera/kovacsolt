<?php

namespace App\Http\Controllers\Panel;

use App\Pattern;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PatternController extends Controller {
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index() {
        $patterns = Pattern::all();

        return view('panel.patterns', [ 'patterns' => $patterns ]);
    }

    public function store() {
        $files = $request->file('images');

        foreach ($files as $file) {
            $pattern = new Pattern;
            $pattern->name = uniqid() . '_' . trim($file->getClientOriginalName());
            $pattern->addMedia($file)->toMediaCollection('patterns');
            $pattern->save();
        }

        return redirect(route('panel.patterns'));
    }

    public function remove($id) {
        Pattern::find($id)->delete();

        return redirect(route('panel.patterns'));
    }

    public function rename($id, Request $request) {
        Pattern::find($id)->update(array('name' => $request->name));

        return redirect(route('panel.patterns'));
    }
}
