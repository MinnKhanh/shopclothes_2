<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PDO;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
            ->get()->toArray();
    }
    public function login(Request $request)
    {
        $loginPath  = url('auth/register');
        $previous   = url()->previous();
        $myPath = url('/');
        if ($previous == $loginPath || $previous == url('auth/')) {
            session(['link' => $myPath]);
        } else {
            session(['link' => $previous]);
        }
        //dd(session('link'));
        return view('auth.login', ['typenav' => $this->typenav]);
    }
    public function register(Request $request)
    {
        return view('auth.register', ['typenav' => $this->typenav]);
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
            'username' => $request->input('username') ? $request->input('username') : $request->email
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
    public function username()
    {
        return 'username';
    }
    public function signin(Request $request)
    {
        if (Auth::attempt(['username' => $request->input('email'), 'password' => $request->password])) {
            return redirect(session('link'));
        } else
            return redirect()->route('auth.login');
        // $user = User::where('email', $request->input('email'))->first();
        // dd(Hash::check($request->input('password'), $user->password));
        // Auth::login();

    }
}
