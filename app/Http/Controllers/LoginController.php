<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function index(Request $request){
        if($request->session()->has('currentUser')){
            $user = DB::table('users')->where('username', $request->session()->get('currentUser'))->first();
            // $user = DB::table('users')->where('email', $request->session()->get('currentUser'))->first();
            if($user->admin == "true"){
                return redirect('/admin');
            }
            else{
                return redirect('/employee');
            }
        }
        else{
            return view('login')->with('message','');
        }
    }

    public function login(Request $request){
        $loginStat = false;

        $email = $request->input('email');
        $password = $request->input('password');
        // return $password;

        if(DB::table('users')->where('email', $email)->first()){
            $user = DB::table('users')->where('email', $email)->first();
            if($user->password == $password){
                $loginStat = true;
                $request->session()->put('currentUser', $user->username);
                $request->session()->put('name', $user->name);
            }
        }
        if($loginStat == true){
            $user = DB::table('users')->where('username', $request->session()->get('currentUser'))->first();
            if($user->admin == "true"){
                return redirect('/admin');
            }
            else{
                return redirect('/employee');
            }
        }
        else{
            return view('login')->with('message','invalid username or password !');
        }
    }
}
