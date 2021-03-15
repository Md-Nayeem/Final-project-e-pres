<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth; //This is needed for the Auth Class

class staff
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
        if(Auth::check()){// login check
            
            if(Auth::user()->role->name == 'Staff'){ // Admin check
                return $next($request);
            }
            return \redirect('404');
        }
        return \redirect()->route('login');
        
    }
}
