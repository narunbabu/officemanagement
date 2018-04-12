<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EmployeeController extends Controller
{
    public function index(Request $request){
        if($request->session()->has('currentUser')){
            $name = $request->session()->get('currentUser');
            $user = DB::table('users')->where('name', $name)->first(); //if we have unique names means?
                // return '$user';
            if($user->admin == "true"){
                return view('admin/admin', ['user' => $user]);
            }
            else{
                return view('employee/employee', ['user' => $user]);
            }
        }
        else{
            return view('errors/unauthorized');
            // return 'good';
        }
    }
}
