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

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/service-reports');
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
    public function store(Request $request)
{
    try {
        // Validate the request data
        $validated = $request->validate([
            'first_name' => 'required|min:2|max:255',
            'middle_name' => 'nullable|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'suffix' => 'nullable|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|min:10|max:255',
            'password' => 'required|confirmed|min:8|max:255',
            'user_type' => 'required',
            'role' => 'required',
            'emp_id' => 'required',
            
        ]);

        // Hash the password
        $validated['password'] = bcrypt($validated['password']);
        $validated['user_type'] = $validated['user_type'] ?? 'User';
        $validated['role'] = $validated['role'] ?? 'TSG';
        $validated['suffix'] = $validated['suffix'] ?? null;

        // Register the user
        $user = User::create($validated);

        // Redirect to a secure page or dashboard
        return redirect('/tsg')->with('message', 'User registered successfully');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Catch validation errors and return to the form with errors
        return redirect()->back()->withErrors($e->validator)->withInput();
        
    } catch (\Exception $e) {
        // Log any unexpected error and show a generic error message
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.');
    }
}

    #update
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'first_name' => 'required|min:2|max:255',
            'middle_name' => 'nullable|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'suffix' => 'nullable|min:2|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone_number' => 'required|min:10|max:255',
            'age' => 'required|numeric|min:1|max:120',
            'user_type' => 'required',
            'role' => 'required',
            'emp_id' => 'required',

        ]);
        $user->update($validated);
        return redirect('/tsg')->with('message', 'User updated successfully');
    }



    
    # Logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login') ->with('message', 'Logged out successfully');
    }


    public function show($id){
        $data = User::where('id', $id)->first();
        dd($data);
        
    }

}
