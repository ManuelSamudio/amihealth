<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PacienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     * @param  \Closure  $next
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->hasRole('Paciente'))
            return $next($request);
        else
            return redirect()->back();
    }
}
