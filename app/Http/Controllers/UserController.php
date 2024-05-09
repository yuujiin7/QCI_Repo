<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        return 'Hello from User Controller';
    }
    
    public function login(){
        if(view()->exists('user.login')){
            return view('user.login');
        }else{
            // return response()->view('errors.404', [], 404);
            return abort(404);
        }
    }

    public function register(){
        return view('user.register');
    }

    public function show($id){
        // $data = array(
        //     'id' => $id,
        //     'name' => 'John Doe',
        //     'email' => 'test@email.com',
        //     'phone' => '123-456-7890',
        // );
        $data = ["data" => "Data from database"];
        return view('user')
            ->with('data', $data)
            ->with('id', $id)
            ->with('name', 'John Doe')
            ->with('email', 'test@email.com')
            ->with('phone', '123-456-7890');
    }

}
