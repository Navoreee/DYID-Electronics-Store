<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request))
        {
            return $this->sendLoginResponse($request);
        }

        $errors = "Email and/or password is incorrect!";
        return redirect()->back()->withErrors($errors)->withInput();
    }

    protected function validateLogin(Request $request)
    {
        $messages = [
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!',
        ];

        $request->validate(
        [
            'email' => 'required|string',
            'password' => 'required|string',
        ], $messages);
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    protected function sendLoginResponse(Request $request)
    {
        if($request->filled('remember'))
        {
            $expiredTime = 300;
            $tokenName = Auth::getRecallerName();
            Cookie::queue($tokenName, Cookie::get($tokenName), $expiredTime);
            Cookie::queue('email_cookie', $request['email'], $expiredTime);
            Cookie::queue('password_cookie', $request['password'], $expiredTime);
        }

        $request->session()->regenerate();

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}