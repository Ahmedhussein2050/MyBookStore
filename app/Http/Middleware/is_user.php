<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class is_user
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
        if ($request->user() != null)
            return $next($request);
        return redirect('users/login');
    }
}
