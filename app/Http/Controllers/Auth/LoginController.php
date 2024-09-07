<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
{
    return view('auth.login');
}


    public function logout(Request $request)
    {
        // Ensure the user is authenticated
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
        }

        // Optionally, add a flash message
        $request->session()->flash('status', 'You have been successfully logged out!');

        return redirect('/login');
    }
}
