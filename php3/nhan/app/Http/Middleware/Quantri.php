<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Quantri
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
        if (auth()->user()->idgroup == 4) {
            return $next($request);
        }
        return redirect('khongcoquyenquantri')->with('loi','Bạn không có quyền admin');
    }
}
