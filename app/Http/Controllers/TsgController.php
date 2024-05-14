<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tsg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Pest\Laravel\json;
use Illuminate\Support\Facades\Log;

class TsgController extends Controller
{
    public function index()
    {   
        $data = array("tsgs" => DB::table('tsgs')->orderBy('created_at', 'desc')-> paginate(10),);

       return view('tsg.index', $data);
    }

    public function show($id)
    {
        $data = Tsg::findOrfail($id);
        // dd($data);
        return view('tsg.edit', ['tsg' => $data]);
    }

    public function create(){
        return view('tsg.create') -> with('title', 'Create TSG');
    }

    public function store(Request $request){
        try {
            Log::info('Request data:', $request->all());

            $validated = $request->validate([
                'first_name' => 'required|min:2|max:255',
                'middle_name' => 'nullable|min:2|max:255',
                'last_name' => 'required|min:2|max:255',
                'suffix' => 'nullable|min:2|max:255',
                'email' => 'required|email|min:2|max:255|unique:tsgs,email',
                'phone_number' => 'required|min:10|max:255',
                'age' => 'required|numeric|min:1|max:120',
                'gender' => 'required',
                'emp_id' => 'required|min:2|max:255|unique:tsgs,emp_id',
            ]);

            Tsg::create($validated);
            return redirect('/tsg')->with('message', 'TSG created successfully.');

        } catch (\Exception $e) {
            Log::error('Error creating TSG:', ['exception' => $e]);
            return back()->withErrors([
                'message' => 'An error occurred. Please try again later.'
            ]);
        }
    }

    // update
    public function update(Request $request, Tsg $tsg)
{
    // Extract the ID of the current record
    $tsgId = $tsg->id;

    // Initial validation for non-unique fields
    $validated = $request->validate([
        'first_name' => 'required|min:2|max:255',
        'middle_name' => 'nullable|min:2|max:255',
        'last_name' => 'required|min:2|max:255',
        'suffix' => 'nullable|min:2|max:255',
        'phone_number' => 'required|min:10|max:255',
        'age' => 'required|numeric|min:1|max:120',
        'gender' => 'required',
    ]);

    // Additional validation for email and emp_id if they are changed
    $uniqueRules = [];
    if ($request->input('email') !== $tsg->email) {
        $uniqueRules['email'] = 'required|email|min:2|max:255|unique:tsgs,email,' . $tsgId;
    }
    if ($request->input('emp_id') !== $tsg->emp_id) {
        $uniqueRules['emp_id'] = 'required|min:2|max:255|unique:tsgs,emp_id,' . $tsgId;
    }

    // If there are unique fields to validate, merge the validations
    if (!empty($uniqueRules)) {
        $uniqueValidated = $request->validate($uniqueRules);
        $validated = array_merge($validated, $uniqueValidated);
    } else {
        $validated['email'] = $tsg->email;
        $validated['emp_id'] = $tsg->emp_id;
    }

    // Update the record with the validated data
    $tsg->update($validated);

    return redirect('/tsg')->with('message', 'TSG updated successfully.');
}


        

    
}



    
