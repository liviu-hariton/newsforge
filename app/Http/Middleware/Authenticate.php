<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : $this->setRedirectTo();
    }

    // redirect the user based on the current route
    protected function setRedirectTo(): ?string
    {
        $routeName = Route::current()->getName();

        // the user tried to access an admin route
        if(preg_match("/admin\./", $routeName)) {
            return route('admin.login');
        }

        // the user tried to access a frontend route
        return route('login');
    }
}
