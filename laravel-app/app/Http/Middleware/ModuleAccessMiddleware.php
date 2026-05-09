<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModuleAccessMiddleware
{
    public function handle(Request $request, Closure $next, string $module): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! $user->hasModuleAccess($module)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'You do not have access to this module.'], 403);
            }

            return redirect('/'.$user->role.'/dashboard.html')
                ->with('error', 'You do not have access to this module.');
        }

        return $next($request);
    }
}
