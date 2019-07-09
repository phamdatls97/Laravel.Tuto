<?php

namespace App\Http\Controllers;
use App\Model\ShipperModel;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    /**
     * Hàm khởi tạo của class được chạy ngay khi khởi tạo đtg
     * Hàm này nó luôn được chạy trước các hàm khác trong class
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:shipper')->only('index');

    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Phương thức trả về view khi đăng nhập seller thành công
     */
    public function index(){
        return view('shipper.dashboard');
    }

    public function create(){
        return view('shipper.auth.register');
    }

    public function store(Request $request){
        $this->validate($request, array(
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ));

        //Khởi tạo model để lưu admin mới
        $shipperModel = new ShipperModel();
        $shipperModel->name = $request->name;
        $shipperModel->email = $request->email;
        $shipperModel->password = bcrypt($request->password);
        $shipperModel->save();

        return redirect()->route('shipper.auth.login');
    }
}
