<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MainController extends Controller
{
    //
    function index(){
        return view("test");
    }

    function checklogin(Request $request){

        $this->validate($request, [
            'email'   => 'required|email',
            'password'  => 'required|alphaNum|min:3'
        ]);

        $user_array=array(
            "email"=>$request->get("email"),
            "password"=>$request->get("password"),
        );

        if (Auth::attempt($user_array)){
            return redirect("main/successlogin");
        }else{
            return back()->with("error","Wrong Login Details");

        }
    }

    function successlogin()
    {
        return view('successlogin');
    }

    function logout()
    {
        Auth::logout();
        return redirect('main');
    }

    function emailAvailable(Request $request){
        if($request->get('email'))
        {
            $email = $request->get('email');
            $data = DB::table("users")
                ->where('email', $email)
                ->count();
            if($data > 0)
            {
                echo 'right';
            }
            else
            {
                echo 'not_right';
            }
        }

    }

}
