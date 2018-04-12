<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function index(Request $request){
        if($request->session()->has('currentUser')){
            $username = $request->session()->get('currentUser');
            // $user = DB::table('employees')->where('username', $username)->first();
            $user = DB::table('users')->where('username', $username)->first();
            // return '$user';
        // if user has admin then it wiil redirect to admin.blade.php
            if($user->admin == "true"){
                return view('admin/admin', ['user' => $user]);
            }
            else{
                return view('employee/employee', ['user' => $user]);
            }
        }
        else{
            return view('errors/unauthorized');
        }
    }
}
