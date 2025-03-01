<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Http\Request;

/**
 * We use current route name to highlight menu items for example.
 * When livewire is updated the route name will become "livewire.update".
 * As a workaround we use the session to store the "original" route name for now.
 */
class StoreOriginalRoute
{
    public function handle(Request $request, Closure $next)
    {
        $route = Route::current();

        if ($route) {
            $routeName = $route->getName();

            if ($routeName && !str_starts_with($routeName, 'livewire.updattt')) {
                session(['original_route_name' => $routeName]);
            }
        }

        return $next($request);
    }
}
