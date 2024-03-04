<?php

namespace App\Http\Middleware;

use App\Models\Consultas;
use Closure;
use Illuminate\Http\Request;

class RestrictAccess
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
        $nivel = Consultas::getNivel();
        if ($nivel < 2) {
            return redirect()->back();
        }
        return $next($request);
    }
}
