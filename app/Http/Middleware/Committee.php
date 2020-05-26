<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Committee
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
        if ( Auth::check() && Auth::user()->isCommittee() )
        {
            return $next($request);
        }

        return redirect('home');
    }
}
