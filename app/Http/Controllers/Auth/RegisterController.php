<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected function validateRegister(Request $request)
    {
        $messages = [
            'name.required' => 'Please write your full name.',
            'gender.required' => 'Please select your gender.',
            'address.required' => 'Please write your address.',
            'email.required' => 'Please write your email.',
            'password.required' => 'Please create a password',
            'tc.required' => 'You must agree with the terms and conditions.',
        ];

        $request->validate(
        [
            'name' => 'required|string|min:5|max:255',
            'gender' => 'required',
            'address' => 'required|min:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'tc' => 'required',
        ], $messages);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validateRegister($request);

        event(new Registered($user = $this->create($request->all())));

        $this->createCart($user->id);

        Auth::guard()->login($user);

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect('/');
    }

    protected function createCart($id)
    {
        $cart = new Cart();
        $cart->user_id = $id;
        $cart->checked_out = 0;

        $cart->save();
    }
}
