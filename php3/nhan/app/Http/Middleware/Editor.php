<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Editor
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
        if (auth()->user()->idgroup == 2) {
            return $next($request);
        }
        return redirect('khongcoquyenquantri')->with('loi','Bạn không có quyền Biên tập viên');
    }
}
