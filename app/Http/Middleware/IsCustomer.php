<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class IsCustomer
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
        $admin_role = [3]; // Customer - 3

        if (!in_array(auth()->user()->role, $admin_role)) {
            Session::flush();
            Auth::logout();
            return redirect('customer/login')->with('error', "Unauthorized page access. Please login first.");
        }

        return $next($request);
    }

}
