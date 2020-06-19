<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

trait AuthenticatesUsers
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login_id' => 'required|string',
            'password' => 'required|string',
        ]);

        //Check whether current login is admin or user
        if(Auth::guard('admin')->attempt(
            $this->credentials($request), $request->filled('remember')
        ) || Auth::guard('user')->attempt(
                $this->credentials($request), $request->filled('remember')
            )) {
            // Attempt success
            $request->session()->regenerate();
            return redirect($this->redirectPath());
        }
    }

    protected function credentials(Request $request)
    {
        return $request->only('login_id', 'password');
    }

    public function logout(Request $request) {
        if(Auth::guard('admin')->check()) {
            //admin logout
            Auth::guard('admin')->logout();
        }
        else if(Auth::guard('user')->check()) {
            //user logout
            Auth::guard('user')->logout();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
