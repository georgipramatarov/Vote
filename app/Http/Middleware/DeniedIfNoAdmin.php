<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Http\Middleware\Response;

class DeniedIfNoAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = "admin_user")
    {

      if(! Auth::guard($guard)->user() || Auth::guard($guard)->user()->authorize == 0){

        abort(403, 'Unauthorized action.');
      }
        return $next($request);
    }
}
