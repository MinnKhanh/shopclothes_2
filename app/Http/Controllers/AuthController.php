<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDO;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }
    public function register(Request $request)
    {
        return view('auth.register');
    }
    public function registering(RegisterRequest $request)
    {
        $password = Hash::make($request->password);
        $role     = $request->input('role');
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $password,
            'phone' => $request->input('phone'),
            'role'     => $role,
        ]);
        // Auth::login($user);
        return redirect('auth.login');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }
    public function signin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        } else return redirect()->route('auth.login');
    }
}
