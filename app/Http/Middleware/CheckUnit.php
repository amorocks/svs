<?php

namespace App\Http\Middleware;

use Closure;

class CheckUnit
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
        if(session('unit', null) == null)
        {
            if(\Auth::user()->unit == null)
            {
                return redirect()->route('unit');
            }
            session(['unit' => \Auth::user()->unit]);
        }

        return $next($request);
    }
}
