<?php
namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admins')
    {
        if (Auth::guard($guard)->check())
        {
            return $next($request);
        }
        else
        {
            return redirect()->route('admin.login.get');
        }
    }
}