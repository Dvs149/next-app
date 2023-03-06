<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (Auth::user()->role == "admin") {
            return $next($request);
        } else {
            Auth::guard('web')->logout();
        	$request->session()->invalidate();
    		$request->session()->regenerateToken();
            return Redirect::back()->withInput()->withErrors(['Invalid credential']);

            // return redirect()->route('login');
        }

        return redirect('/');
    }
}
