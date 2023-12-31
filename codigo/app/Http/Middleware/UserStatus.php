<?php

namespace App\Http\Middleware;

use Closure, Auth;

class UserStatus
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
        if(Auth::user()->estado != "1"):
            return $next($request);
        else:
            return redirect('/cerrar_sesion');
        endif;
    }
}
