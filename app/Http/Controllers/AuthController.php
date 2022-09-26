<?php

namespace App\Http\Controllers;

use App\Events\RegisterEvent;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendEmail;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            parent::__construct();
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

        $listroles = DB::table('permissions')->pluck('name', 'id');
        return view('auth.register', ['typenav' => $this->typenav, 'listroles' => $listroles]);
    }
    public function registering(RegisterRequest $request)
    {
        $password = Hash::make($request->password);
        $roles     = $request->input('role');
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $password,
            'phone' => $request->input('phone'),
            'username' => $request->input('username') ? $request->input('username') : $request->email
        ]);
        $user->syncRoles($roles);
        $rolePermissions = DB::table('role_has_permissions')->whereIn('role_id', [$roles])->get()->pluck('permission_id')->unique()->toArray();
        $user->permissions()->sync($rolePermissions);
        // RegisterEvent::dispatch($user);
        SendEmail::dispatch('Chúc mừng bạn đã đăng kí tài khoản thành công', $user);
        // Auth::login($user);
        return redirect()->route('auth.login');
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
    public function updateAccont(Request $request)
    {
        return view('auth.changeaccount', ['typenav' => $this->typenav]);
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        if (Hash::check($request->input('password'), $user->password)) {
            $password = Hash::make($request->input('password'));
            User::where('id', $user->id)->update([
                'password' => $password
            ]);
            return redirect()->route('auth.login');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Thất bại']);
        }
    }
}
