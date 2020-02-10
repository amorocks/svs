<?php

namespace App\Http\Middleware;

use Closure;

class Level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
        //Level is too low...
        if(\Auth::user()->level < $level)
        {
            if(\Auth::user()->level == 0)
                return redirect()->route('student');
            return redirect()->route('home');
        }

        return $next($request);
    }
}
