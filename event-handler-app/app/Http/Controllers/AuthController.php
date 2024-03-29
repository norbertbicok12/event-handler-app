<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return response()->json(['success' => true], 200);
        }

        // Authentication failed
        return response()->json(['error' => 'User does not exist'], 422);
    }

    public function registerPost(Request $request) {
        $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:user',
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6',
           'place_of_birth' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['place_of_birth'] = $request->place_of_birth;

        $user = User::create($data);
        if ($user) {
            // Log in the user
            Auth::login($user);

            // Authentication passed
            return response()->json(['success' => true, 'user' => $user], 200);
        } else {
            // User creation failed
            return response()->json(['error' => 'User registration failed'], 422);
        }

    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
