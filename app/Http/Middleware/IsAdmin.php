<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class IsAdmin
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
        $admin_role = [1, 2]; // Admin - 1, Staff - 2

        if (!in_array(auth()->user()->role, $admin_role)) {
            Session::flush();
            Auth::logout();
            return redirect('admin/login')->with('error', "Unauthorized page access. Please login first.");
        }

        return $next($request);
    }

}
