<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\SellerModel;
class SellerController extends Controller
{
    /**
     * Hàm khởi tạo của class được chạy ngay khi khởi tạo đtg
     * Hàm này nó luôn được chạy trước các hàm khác trong class
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:seller')->only('index');

    }

    /**
 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
 * Phương thức trả về view khi đăng nhập seller thành công
 */
    public function index(){
        return view('seller.dashboard');
    }

    public function create(){
        return view('seller.auth.register');
    }

    public function store(Request $request){
        $this->validate($request, array(
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ));

        //Khởi tạo model để lưu admin mới
        $sellerModel = new SellerModel();
        $sellerModel->name = $request->name;
        $sellerModel->email = $request->email;
        $sellerModel->password = bcrypt($request->password);
        $sellerModel->save();

        return redirect()->route('seller.auth.login');
    }
}
