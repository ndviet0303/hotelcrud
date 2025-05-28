<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            abort(403, 'Bạn không có quyền truy cập chức năng này!');
        }
        $userRole = Auth::user()->role;
        $roles = 'receptionist';
        if (empty($roles)) {
            abort(403, 'Bạn không có quyền truy cập chức năng này!');
        }
        if ($userRole != $roles) {
            abort(403, 'Bạn không có quyền truy cập chức năng này!');
        }
        return $next($request);
    }
}
