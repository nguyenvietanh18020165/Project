<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    protected $userservice;
    public function __construct(UserService $userService)
    {
        $this->userservice = $userService;
    }

    public function profile(){

        $data = [
            "title" => "Hồ sơ",
            "pages" => [
                "pages.profile",
            ],
            'user' => Auth::user(),
            'infor' => $this->userservice->infor()
        ];
        return view('master_layout', $data);
    }

    public function update(Request $request){
        $result =  $this->userservice->updateProfile($request);
        if($result){
            return redirect()->back()->with('status', 'Đã cập nhật thông tin');
        }
        return redirect()->back()->with('error', 'Vui lòng kiểm tra lại thông tin hoặc liên hệ bộ phân hỗ trợ');
    }

    public function allUser(){
        $user = $this->userservice->allUser();
        $data = [
          'user' => $user
        ];
        return view('pages.admin_user_infor', $data);
    }

    public function allVendor(){
        $user = $this->userservice->allVendor();
        $data = [
            'user' => $user
        ];
        return view('pages.admin_user_infor', $data);
    }

    public function allAdmin(){
        $user = $this->userservice->allAdmin();
        $data = [
            'user' => $user
        ];
        return view('pages.admin_user_infor', $data);
    }
    public function isAdmin($id){
        return $this->userservice->actionAdmin($id, 'is_admin');
    }

    public function unAdmin($id){
        return $this->userservice->actionAdmin($id, 'un_admin');
    }
    public function isVendor($id){
        return $this->userservice->actionAdmin($id, 'is_vendor');
    }
    public function unVendor($id){
        return $this->userservice->actionAdmin($id, 'un_vendor');
    }
    public function resetPass($id){
        return $this->userservice->actionAdmin($id, 'reset_pass');
    }

    public function orderDetail(){
        $order = $this->userservice->allOrder();
        $data = [
            'order' => $order
        ];
        return view('pages.order_detail', $data);
    }
    public function resetPW($newPass, $oldPass){
        $result = $this->userservice->resetPassW($newPass, $oldPass);
        return $result;
    }

}
