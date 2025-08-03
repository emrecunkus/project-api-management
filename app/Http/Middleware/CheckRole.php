<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Kullanıcının rolünü kontrol et (tek veya çoklu).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userRole = Auth::user()->role;

        $roleList = explode('|', $roles); // admin|customer gibi string'i diziye çevir

        if (!in_array($userRole, $roleList)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
