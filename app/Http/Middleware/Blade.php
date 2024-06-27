<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Blade
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                $permissions = json_decode($user->role->permissions);
                
                $whereNotIn = [1,2,3,4,5];
                $whereIn = array_diff($permissions,$whereNotIn);
                
                $menus = Menu::whereNull('parent')
                ->where(function ($q) use ($whereNotIn,$whereIn)
                {
                    $q->whereIn('id',$whereIn)
                    ->whereNotIn('id',$whereNotIn);
                })
                ->with('childs')->get();
                
                view()->share('menus', $menus);
            }
        }

        return $next($request);
    }
}
