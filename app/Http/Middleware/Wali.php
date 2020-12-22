<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Wali
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
        if ($request->user()->level != "Wali Kelas") {
            return redirect()->back();
        } else {
            return $next($request);
        }
    }
}
