<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function __construct()
    {
//        $this->middleware('guest');
    }

    public function registration(RegistrationRequest $request)
    {
        // Create a new user
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();

        // Flash a success message to the session
        session()->flash('success', 'Registration successful! You can now log in.');

        // Redirect to a success page or another appropriate page
        return redirect('/login'); // Redirect to the login page or another route
    }

    public function login(LoginRequest $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $request->input('remember'))) {
            return redirect('/');
        }

        // Redirect to a success page or another appropriate page
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['login' => 'Invalid email or password']); // Flash a custom error message;

    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logs the user out
        $request->session()->invalidate(); // Invalidates the user's session
        $request->session()->regenerateToken(); // Regenerates the CSRF token

        return redirect('/login'); // Redirect to the home page or any other desired URL
    }
}
