<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    protected $auth;

    public function __construct(\Illuminate\Contracts\Auth\Factory $auth)
    {
        $this->auth = $auth;
    }
    
    public function index(Request $request)
    {
        // dd($request);
        // $data = User::all();
        
        // return view('tsg.index', ['users' => $data]);
        return ('User Hello!');
    }
    
    # Login
    public function login(){

         // Check if the user is already authenticated
        if (Auth::check()) {
            return redirect('/service-reports');  // Redirect to TSG page if authenticated
        }

        // Check if the login view exists
        if (view()->exists('user.login')) {
            return view('user.login');  // Show login view for guests
        } else {
            return abort(404);  // Return 404 error if login view does not exist
        }
    }

    # Process
    public function process(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt($validated)){
            $request->session()->regenerate();
            return redirect('service-reports')->with('message', 'Logged in successfully');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]) -> onlyInput('email');

    }

    # Register
    public function register(){
        return view('user.register');
    }

    # Store
    public function store(Request $request){
        
            $validated = $request->validate([
                'first_name' => 'required|min:2|max:255',
                'middle_name' => 'nullable|min:2|max:255',
                'last_name' => 'required|min:2|max:255',
                'suffix' => 'nullable|min:2|max:255',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|min:10|max:255',
                'password' => 'required|confirmed|min:8|max:255',
                'user_type' => [Rule::in(['admin', 'user'])],
                'role' => [Rule::in(['engineer','manager','admin'])],
            ], [
                'first_name.required' => 'First name is required.',
                'first_name.min' => 'First name must be at least :min characters.',
                'first_name.max' => 'First name may not be greater than :max characters.',
                'last_name.required' => 'Last name is required.',
                'last_name.min' => 'Last name must be at least :min characters.',
                'last_name.max' => 'Last name may not be greater than :max characters.',
                'email.required' => 'Email is required.',
                'email.email' => 'Invalid email format.',
                'email.unique' => 'Email is already taken.',
                'phone_number.required' => 'Phone number is required.',
                'phone_number.min' => 'Phone number must be at least :min characters.',
                'phone_number.max' => 'Phone number may not be greater than :max characters.',
                'password.required' => 'Password is required.',
                'password.confirmed' => 'Passwords do not match.',
                'password.min' => 'Password must be at least :min characters.',
                'password.max' => 'Password may not be greater than :max characters.',
                'user_type.in' => 'Invalid user type.',
                'role.in' => 'Invalid role.',
            ]);
    
            $validated['password'] = bcrypt($validated['password']);
            $validated['user_type'] = $validated['user_type'] ?? 'user';
            $validated['role'] = $validated['role'] ?? 'engineer';
    
            if (!isset($validated['suffix'])) {
                $validated['suffix'] = null;
            }
            
            // Create the user
            $user = User::create($validated);
            
            // Optionally, redirect the user after successful registration
            return redirect('/login')->with('message', 'User created successfully');
        }
    
    
    # Logout
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login') ->with('message', 'Logged out successfully');
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
