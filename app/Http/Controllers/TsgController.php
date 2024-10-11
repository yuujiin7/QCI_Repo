<?php

namespace App\Http\Controllers;

use App\Models\Tsg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\User;


class TsgController extends Controller
{
    public function index()
    {
        // $data = Tsg::all();
        $user = User::all();
        return view('tsg.index', ['users' => $user]);
        
    }

    public function show($id)
    {
        // $data = Tsg::findOrFail($id);
        $user = User::findOrFail($id);
        // dd($user);
        return view('tsg.edit', ['user' => $user]);
    }

    public function create()
    {
        return view('tsg.create')->with('title', 'Create TSG');
    }

    public function store(Request $request)
    {
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

    public function update(Request $request, $id)
{
    // $post = Tsg::findOrFail($id);
    $post = User::findOrFail($id);
    $int_id = intval($id);
     // Log the $id to verify
     Log::info('Casting $id to integer: ' . $id);
     // Log the incoming request data for debugging
     Log::info('Request data: ' . json_encode($request->all()));


    $validated = $request->validate([
        'first_name' => 'required|min:2|max:255',
        'middle_name' => 'nullable|min:2|max:255',
        'last_name' => 'required|min:2|max:255',
        'suffix' => 'nullable|min:2|max:255',
        'email' => 'required|email|min:2|max:255|unique:tsgs,email,' . $id,
        'phone_number' => 'required|min:10|max:255',
        // 'age' => 'required|numeric|min:1|max:120',
        // 'gender' => 'required',
        'emp_id' => 'required|min:2|max:255|unique:tsgs,emp_id,' . $id,
    ]);

    if ($request->hasFile('profile_image')) {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $filenameWithExtension = $request->file('profile_image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $request->file('profile_image')->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $thumbnailFileNameToStore =  $fileNameToStore;

        // Store original image
        $request->file('profile_image')->storeAs('public/profile_images', $fileNameToStore);

        // Create and save thumbnail
        $thumbnailPath = 'public/profile_images/thumbnail/' . $thumbnailFileNameToStore;
        $request->file('profile_image')->storeAs('public/profile_images/thumbnail', $thumbnailFileNameToStore);

        $this->createThumbnail(storage_path('app/' . $thumbnailPath), 150, 93);

        // Update form fields with image paths
        $validated['profile_image'] = $fileNameToStore;
    }
    // dd($validated);
    $post->update($validated);
    return back()->with('message', 'TSG updated successfully.');
    }

    public function destroy($id)
    {
        $tsg = User::findOrFail($id);
        $tsg->delete();
        return redirect('/tsg')->with('message', 'TSG deleted successfully.');
    }


    // Create thumbnail
    public function createThumbnail($path, $width, $height)
    {
        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($path);
            $image->scale($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            // dd($image);
            $image->save($path);
        } catch (\Exception $e) {
            // Log or handle the exception as needed
            Log::error('Error creating thumbnail: ' . $e->getMessage());
        }
        
    }


   
}




    
