<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    //

    public function index(Request $request)
    {
//        $credentials = $request->validate([
//            'email' => ['required', 'email'],
//            'password' => ['required'],
//        ]);
//        if(Auth::check()){
//            return Auth::id();
//        }else{
//            if (Auth::attempt($credentials)) {
//                $request->session()->regenerate();
////                return redirect()->intended('dashboard');
//                return Auth::id();
//            }
//            return ['msg' => 'false'];
//        }
        User::create([
           'name' => $request->name,
           'email'
        ]);
        return response()->json(['action' => 'ok'], 200);
    }



}
