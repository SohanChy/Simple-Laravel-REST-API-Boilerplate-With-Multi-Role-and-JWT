<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if( $user->hasRole($role) ){
            return $next($request);
        }

        return User::roleErrorResponse();

    }
}
