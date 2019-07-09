<?php

namespace App\Http\Controllers\Auth\Shipper;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:shipper')->except('logout');
    }

    public function login(){
        return view('shipper.auth.login');
    }

    /**
     * Phương thức trả về view để đăng nhập cho seller
     * lấy thông tin form có method là POST
     */
    public function loginShipper(Request $request)
    {
        $this->validate($request, array(
            'email' => 'required|email',
            'password' => 'requỉred|min:6'
        ));

        //Đăng nhập
        if (Auth::guard('seller')->attempt(
            ['email' => $request->email, 'password' => $request->password],$request->remember
        )) {
            //Nếu đăng nhập thành công thì chuyển hướng về view dashboard của admin
            return redirect()->intended(route('shipper.dashboard'));
        }
        //Nếu đăng nhập thất bại thì quay trở về form đăng nhập với giá trị của 2 ô input cũ: email và remember
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    /**
     * Phương thức trả về view để đăng xuất
     */
    public function logout(){
        Auth::guard('shipper')->logout();
        //chuyển hướng về trang login của admin
        return redirect()->route('shipper.auth.login');
    }
}
