<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $this->setRedirectTo();
            }
        }

        return $next($request);
    }

    protected function setRedirectTo(): RedirectResponse
    {
        $user = Auth::user();

        if($user && $user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if($user && $user->hasRole('user')) {
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('home');
    }
}
