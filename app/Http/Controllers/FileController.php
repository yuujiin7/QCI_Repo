<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function show($folder, $file)
    {
        $path = storage_path("app/images/{$folder}/{$file}");

        if (!Storage::exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
