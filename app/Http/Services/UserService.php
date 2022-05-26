<?php


namespace App\Http\Services;


use App\Models\images;
use App\Models\Payment;
use App\Models\User;
use App\Models\User_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::check()){
            return json_decode(Auth::id());
        }else{
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return json_decode(Auth::id());
            }
            return json_decode(['msg' => 'false']);
        }
    }

    public function infor(){
        $result =  User_info::where('user_id', Auth::id())->first();
        return $result;
    }

    public function updateProfile($request){
        $fileName = false;
        $check = User_info::where('user_id', Auth::id())->get();
        $date=date_create((string)$request->input("birthday"));
        date_time_set($date, 0, 0, 0);
        $birthday =  date_format($date,"Y-m-d");

        if ($request->hasfile('avatar')) {
            $files = $request->file("avatar");
            $ext = $files->extension();
            $fileName = 'avatar-' . time() . '.' . $ext;
            $files->move(public_path("upload/images/avatar"), $fileName);
            if(count($check) > 0){
                User_info::where('user_id', Auth::id())->update([
                    'birthday' => $birthday,
                    'gender' => (int)$request->input('gender'),
                    'phone' => (string)$request->input('phone'),
                    'address' => (string)$request->input('address'),
                    'webisite' => (string)$request->input('webisite'),
                    'avatar' => 'upload/images/avatar/'.$fileName
                ]);
                User::where('id', Auth::id())->update([
                    'name' => (string)$request->input("name"),
                ]);
                return true;
            }else{
                User_info::create([
                    'birthday' => $birthday,
                    'gender' => (int)$request->input('gender'),
                    'phone' => (string)$request->input('phone'),
                    'address' => (string)$request->input('address'),
                    'user_id' => Auth::id(),
                    'webisite' => (string)$request->input('webisite'),
                    'avatar' => 'upload/images/avatar/'.$fileName
                ]);
                User::where('id', Auth::id())->update([
                    'name' => (string)$request->input("name"),
                ]);
                return true;
            }
        }else{
            if(count($check) > 0){
                User_info::where('user_id', Auth::id())->update([
                    'birthday' => $birthday,
                    'gender' => (int)$request->input('gender'),
                    'phone' => (string)$request->input('phone'),
                    'webisite' => (string)$request->input('webisite'),
                    'address' => (string)$request->input('address')
                ]);
                User::where('id', Auth::id())->update([
                    'name' => (string)$request->input("name"),
                ]);

            }else{
                User_info::create([
                    'birthday' => $birthday,
                    'gender' => (int)$request->input('gender'),
                    'phone' => (string)$request->input('phone'),
                    'address' => (string)$request->input('address'),
                    'webisite' => (string)$request->input('webisite'),
                    'user_id' => Auth::id()
                ]);
                User::where('id', Auth::id())->update([
                    'name' => (string)$request->input("name"),
                ]);
            }
        }


        return false;
    }

    public function allUser(){
        $user = User::all();
        for($i = 0; $i < count($user); $i++){
            $infor = User_info::where('user_id', $user[$i]->id)->first();
            if(isset($infor->birthday)){
                $user[$i]->birthday = $infor->birthday;
                $user[$i]->gender = $infor->gender;
                $user[$i]->phone = $infor->phone;
                $user[$i]->address = $infor->address;
                $user[$i]->webisite = $infor->webisite;
            }

        }
        return $user;
    }

    public function allVendor(){
        $user = User::where('is_admin', 2)->get();
        for($i = 0; $i < count($user); $i++){
            $infor = User_info::where('user_id', $user[$i]->id)->first();
            if(isset($infor->birthday)){
                $user[$i]->birthday = $infor->birthday;
                $user[$i]->gender = $infor->gender;
                $user[$i]->phone = $infor->phone;
                $user[$i]->address = $infor->address;
                $user[$i]->webisite = $infor->webisite;
            }

        }
        return $user;
    }

    public function allAdmin(){
        $user = User::where('is_admin', 1)->get();
        for($i = 0; $i < count($user); $i++){
            $infor = User_info::where('user_id', $user[$i]->id)->first();
            if(isset($infor->birthday)){
                $user[$i]->birthday = $infor->birthday;
                $user[$i]->gender = $infor->gender;
                $user[$i]->phone = $infor->phone;
                $user[$i]->address = $infor->address;
                $user[$i]->webisite = $infor->webisite;
            }

        }
        return $user;
    }
    public function actionAdmin($id, $action){
        if($action == 'is_admin'){
            User::where('id', $id)->update([
                'is_admin' => 1
            ]);
            return true;
        }
        if($action == 'un_admin'){
            User::where('id', $id)->update([
                'is_admin' => 0
            ]);
            return true;
        }
        if($action == 'is_vendor'){
            User::where('id', $id)->update([
                'is_admin' => 2
            ]);
            return true;
        }
        if($action == 'un_vendor'){
            User::where('id', $id)->update([
                'is_admin' => 0
            ]);
            return true;
        }
        if($action == 'reset_pass'){
            User::where('id', $id)->update([
                'password' => Hash::make('123456')
            ]);
            return true;
        }
    }

    public function getPayment(){
        return Payment::where('user_id', Auth::id())->where('status', '!=', 0)->first();
    }

    public function allOrder(){
        $result = Payment::all();
        for($i = 0; $i < count($result); $i++){
            $user = User::where('id', $result[$i]->user_id)->first();
            $infor = User_info::where('user_id', $user->id)->first();
            if(isset($infor->birthday)){
                $user->birthday = $infor->birthday;
                $user->gender = $infor->gender;
                $user->phone = $infor->phone;
                $user->address = $infor->address;
                $user->webisite = $infor->webisite;

            }
            $result[$i]->user = $user;
        }
        return $result;
    }
    public function resetPassW($newPass, $oldPass){
        $result = User::where('id', Auth::id())->first();
        if (Hash::check($oldPass, $result->password)) {
            User::where('id', Auth::id())->update([
                'password' => Hash::make($newPass)
            ]);
            return 1;
        }
        return 0;

        
    }
}
