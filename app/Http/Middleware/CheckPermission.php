<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        // echo $roles;
        $allowRole = explode('|', $roles); //chuyển đổi $role thành một mảng dựa trên ký tự |
        if (in_array(Auth::user()->getStrType(), $allowRole)) {
            return $next($request);
        } else {
            return redirect()->route('tables.index');
        }
    }
}
