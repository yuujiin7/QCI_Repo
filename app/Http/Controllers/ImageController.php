<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SRImage;

class ImageController extends Controller
{
    public function sr_upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $imageData = file_get_contents($image);
        
        SRImage::create([
            'name' => $image->getClientOriginalName(),
            'image_data' => $imageData,
        ]);

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }

    public function sr_download($id)
    {
        $image = SRImage::findOrFail($id);
        return response()->streamDownload(function () use ($image) {
            echo $image->image_data;
        }, $image->name);
    }


    
}
