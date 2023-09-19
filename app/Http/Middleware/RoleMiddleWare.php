<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $role): Response
    {

        // dump(auth()->user()->roles());

        if (!auth()->check()) {
            abort(401);
        }

        if (!auth()->user()->roles()->where('name', $role)->exists()) {
            // abort(403);
            response()->json(['message' => "Unauthorized Access"], 403);
        }

        return $next($request);
    }
}