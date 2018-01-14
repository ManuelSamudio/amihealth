<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->hasRole('Administrador')){
                return redirect('dashboard');
            }
            elseif (Auth::user()->hasRole('Paciente')){
                return redirect('home');
            }
            elseif (Auth::user()->hasRole('Medico')){
                return redirect('show-patients');
            }
            //return redirect('/home');
        }

        return $next($request);
    }
}
