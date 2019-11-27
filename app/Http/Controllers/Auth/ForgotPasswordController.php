<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller {
  use SendsPasswordResetEmails;

  public function __construct() {
    $this->middleware('guest');
  }

  public function broker()
  {
      return Password::broker('users');
  }
}
