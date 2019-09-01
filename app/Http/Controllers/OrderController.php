<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller {
  public function profile() {
    if (Auth::guard('web')->check()) {
      return redirect(route('order.billing'));
    }

    return view('page.order.profile', [ 'step' => 0 ]);
  }

  public function billing(Request $request) {
    return view('page.order.billing', [ 'step' => 1, 'billingData' => session()->get('billingData') ]);
  }

  public function billingPost(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'zip' => 'required|max:4',
      'city' => 'required',
      'address' => 'required',
      'email' => 'required|email'
    ], [
      'name.required' => 'Ki kéne tölteni...'
    ]);

    $request->session()->put('billingData', $request->all());

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    } else {
      return redirect(route('order.shipping'));
    }
  }

  public function shipping() {
    return view('page.order.shipping', [ 'step' => 2 ]);
  }

  public function payment() {
    return view('page.order.payment', [ 'step' => 3 ]);
  }

  public function finalize() {
    return view('page.order.finalize', [ 'step' => 4 ]);
  }
}
