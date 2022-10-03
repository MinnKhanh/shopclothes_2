<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassAccountRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendEmail;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->typenav = Type::with('Img', 'Categories')->withCount('Product')
        //     ->get()->toArray();
        parent::__construct();
    }
    public function login(Request $request)
    {
        $loginPath  = url('auth/register');
        $previous   = url()->previous();
        $myPath = url('/');
        if ($previous == $loginPath || $previous == url('auth/') || $previous == url('auth/update-account')) {
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

        return redirect()->route('index');
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
            return Redirect::back()->withErrors(['msg' => 'Đăng nhập thất bại, có thể bạn đã nhập sai tài khoản hoặc mật khẩu vui lòng thử lại']);
        // $user = User::where('username', $request->input('email'))->first();
        // dd(Hash::check($request->input('password'), $user->password));
        //Auth::login();
    }
    public function updateAccont(Request $request)
    {
        return view('auth.changepassword', ['typenav' => $this->typenav]);
    }
    public function update(ChangePassAccountRequest $request)
    {
        $user = auth()->user();
        if (Hash::check($request->input('password'), $user->password)) {
            $password = Hash::make($request->input('newpassword'));
            User::where('id', $user->id)->update([
                'password' => $password
            ]);
            return redirect()->route('auth.login');
        } else {
            return Redirect::back()->withInput($request->input())->withErrors(['msg' => 'Thất bại, có thể sai mật khẩu hoặc tài khoản hãy thử lại']);
        }
    }
    public function updateByEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'newpassword' => 'required',
            'newpassword_confirmation' => 'required',
        ]);
        $password = Hash::make($request->input('newpassword'));
        User::where('email', $request->input('email'))->update([
            'password' => $password
        ]);
        return redirect()->route('auth.login');
    }
    public function forgotPassword(Request $request)
    {
        return view('auth.sendmailtoconfirm', ['typenav' => $this->typenav]);
    }
    public function sendConfirm(Request $request)
    {
        if ($request->input('email')) {
            $count = User::where('email', $request->input('email'))->get()->count();
            if ($count) {
                SendEmail::dispatch('Vui lòng nhấn vào đây để lấy lại mật khẩu', null, 2, $request->input('email'));
                return Redirect::route('index');
            }
        }
        return Redirect::back()->withInput($request->input())->withErrors(['email' => 'Email không hợp lệ vui lòng nhập lại email bạn đã đăng kí trong tài khoản của bạn!']);
    }
    public function resetPassword(Request $request)
    {
        return view('auth.resetpassword', ['email' => $request->input('email'), 'typenav' => $this->typenav]);
    }
}
