<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // custom pengecekan autotentifikasi
        // jika yang login tamu atau bukan namanya taufik maka saat klik menu post category akan muncul forbidden 403
        if(auth()->guest() || !auth()->user()->is_admin){
            abort(403);
        }
        // end custom

        return $next($request);
    }
}
