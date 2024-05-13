<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        // $data = User::all();
        
        // return view('tsg.index', ['users' => $data]);

        return ('User Hello!');

        
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

    public function store(Request $request){
        try {
            $validated = $request->validate([
                'first_name' => ['required', 'min:2', 'max:255'],
                'middle_name' => ['required', 'min:2', 'max:255'],
                'last_name' => ['required', 'min:2', 'max:255'],
                'suffix' => 'nullable|min:2|max:255',
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'phone_number' => ['required', 'min:10', 'max:255'],
                'password' => 'required|confirmed|min:8',
            ]);
    
            $validated['password'] = bcrypt($validated['password']);
            
            if (!isset($validated['suffix'])) {
                $validated['suffix'] = null;
            }
            $user = User::create($validated);
            // dd($user);
            // auth()->login($user);

    
            // Optionally, redirect the user after successful registration
            return redirect('/login') ->with('message', 'User created successfully');
            
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating user: ' . $e->getMessage());
    
            // Optionally, return a response indicating the error
            return back()->withInput()->withErrors(['error' => 'An error occurred while registering. Please try again later.']);
        
        }
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login') ->with('message', 'User logged out successfully');
    }

    public function show($id){
        // $data = User::find($id);
        // $data = ["data" => "Data from database"];
        // data from sql
        $data = User::where('id', $id)->first();
        dd($data);

        // return view('user')
        //     ->with('data', $data)
        //     ->with('id', $id)
        //     ->with('first_name', 'John')
        //     ->with('middle_name', 'Fernando')
        //     ->with('last_name', 'Doe')
        //     ->with('suffix', 'Jr.')
        //     ->with('email', 'test@email.com')
        //     ->with('phone_number', '123-456-7890');
        
    }

}
