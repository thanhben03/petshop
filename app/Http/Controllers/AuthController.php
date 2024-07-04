<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    

    public function processLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $user = Account::where([
            ['username','=', $username]
        ])->first();
        if ($user && Hash::check($password,$user->password)) {
            session()->put('id', $user->id);
            session()->put('email', $user->email);
            session()->put('fullname', $user->fullname);
            session()->put('address', $user->address);
            session()->put('level', $user->level);
            session()->put('confirm_address', $user->confirm_address);
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('msg','Tài khoản hoặc mật khẩu không chính xác !');
        }
    }
    public function login()
    {
        if (session()->has('id')) {
            return redirect()->back();
        }
        return view('client.login');
    }
    
    public function register()
    {
        return view('client.register');
    }

    public function processRegister(RegisterRequest $request)
    {
        $arr = $request->validated();
        $arr['password'] = Hash::make($request->password);
        Account::create($arr);

        return redirect()->back()->with('msg','Đăng ký thành công !');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home');
    }

}
