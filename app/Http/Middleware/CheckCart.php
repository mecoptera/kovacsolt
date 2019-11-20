<?php

namespace App\Http\Middleware;

use Closure;
use Webacked\Cart\Facades\Cart;

class CheckCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (count(Cart::get()) === 0) {
        return redirect(route('page.products'));
      }

      return $next($request);
    }
}
