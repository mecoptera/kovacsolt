<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }

  public function activate() {
    return view('user.register-activate');
  }

  public function index() {
    $userData = Auth::user();
    $emailResets = DB::table('email_resets')->where('user_id', '=', $userData->id)->get()->toArray();

    return view('user.profile', [
      'userData' => $userData,
      'emailResets' => $emailResets
    ]);
  }

  public function saveProfile(Request $request) {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email'
    ], [
      'name.required' => 'Nem hagyhatod üresen',
      'email.required' => 'Nem hagyhatod üresen',
      'email.email' => 'Nem megfelelő formátum'
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->with('error', 'Nem tudtuk menteni a változtatásokat, mert a megadott adatokban hiba van. Ellenőrizd a pirossal jelzett mezőket és próbáld újra!');
    } else {
      $userData = Auth::user();

      if ($userData->email !== $request->input('email')) {
        DB::table('email_resets')->where('user_id', $userData->id)->update(['created_at' => NULL]);
        DB::table('email_resets')->insert(['user_id' => $userData->id, 'email' => $request->input('email'), 'token' => str_random(32)]);
      }

      return redirect()->back()->with('success', 'A változtatásokat sikeresen mentettük!');
    }
  }

  public function resetPassword() {
    Password::sendResetLink(['email' => Auth::user()->email], function (Illuminate\Mail\Message $message) {
      $message->subject('Új jelszó beállítása');
    });

    return redirect()->back();
  }
}
