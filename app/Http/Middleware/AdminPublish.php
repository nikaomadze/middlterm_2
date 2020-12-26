<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\models\User;

class AdminPublish
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
        if ($request->user()->role != 'admin') {
            return abort(403);
        }
        return $next($request);
    }
}
