<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function registerIndex(){
        return view('client.pages.register');
    }
    public function loginIndex(){
        return view('client.pages.login');
    }

    public function login(LoginRequest $request){
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if(Auth::attempt($data)){
            $roleId = Auth::user()->role_id;
            $status = Auth::user()->status;
            if($status != 'active'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return to_route('auth.loginIndex')->with(['message'=>'Tài khoản này đã bị khóa']);
            }
            else if($roleId == 2){
                return redirect()->intended()->with(['success'=>'Đăng nhập thành công']);
            }
            else{
                return to_route('admin.index')->with(['success'=>'Đăng nhập thành công']);
            }
        }
        return to_route('auth.loginIndex')->with(['message'=>'Email hoặc mật khẩu không chính xác']);
    }

    public function register(RegisterRequest $request){
        $data = $request->all();
        $user = User::create($data);
        Auth::login($user);
        return redirect()->intended()->with(['success'=>'Đăng ký tài khoản thành công']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('home.index');
    }
}
