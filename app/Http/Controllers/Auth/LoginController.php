<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $routeName = Route::current()->getName();

        $login_view = 'frontend-login';

        if(preg_match("/admin\./", $routeName)) {
            $login_view = 'backend-login';
        }

        return view('auth.'.$login_view);
    }

    public function redirectTo()
    {
        $user = Auth::user();

        if($user && $user->hasRole('admin')) {
            $this->redirectTo = route('admin.dashboard');
        }

        if($user && $user->hasRole('user')) {
            $this->redirectTo = route('user.dashboard');
        }

        return $this->redirectTo;
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : $this->setLogoutRedirectTo($user);
    }

    protected function setLogoutRedirectTo($user): RedirectResponse
    {
        if($user && $user->hasRole('admin')) {
            return redirect()->route('admin.login')->with('success', 'You have successfully logged out!');
        }

        if($user && $user->hasRole('user')) {
            return redirect()->route('login')->with('success', 'You have successfully logged out!');
        }

        return redirect('/');
    }
}
