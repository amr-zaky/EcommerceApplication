<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{

    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check())
            return $next($request);
        else
            return redirect()->route('adminLogin')->with('status', 'login_error')->with('message', 'Please Login');

    }

}
