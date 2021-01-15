<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{

    public function index()
    {
        return view('layouts.login');
    }

    public function showSignup(){
        return view('layouts.signup');
    }

    public function login(Request $request)
    {
//        if($username = $request->username &&
//        $password = $request->Password){
//            if ($username == 'admin' && $password == '123') {
//
//                $request->session()->push('login', true);
//
//                return redirect()->route('cities.list');
//            }
//
//            // Nếu thông tin đăng nhập không chính xác, gán thông báo vào Session
//            $message = 'Đăng nhập không thành công. Tên người dùng hoặc mật khẩu không đúng.';
//            $request->session()->flash('login-fail', $message);
//
//            //Quay trở lại trang đăng nhập
//            return view('layouts.login');
//
//        }
//
//        $message = 'Ban nhap thieu. Vui long nhap day du thong tin';
//     signup   $request->session()->flash('login-fail', $message);
//        return view('layouts.login');

        $date = ['email' => $request->email,
            'password' => $request->password];
        if (Auth::attempt($date)){
            return redirect()->route('cities.list');
        }
        $message = 'Đăng nhập không thành công. Tên người dùng hoặc mật khẩu không đúng.';
        $request->session()->flash('login-fail', $message);
;
        return view('layouts.login');
    }

    public function signup(SignupRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->password =Hash::make($request->password);
        $user->save();
        return redirect()->route('show.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('show.login');
    }
}
