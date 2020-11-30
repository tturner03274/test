<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Storage;

class PartsRequestImageController extends Controller
{
    public function store(Request $request)
    {
        // Auth in route middleware

        // validate images
        $request->validate([
            'image' => 'image|max:5000',
        ]);

        // Set the directory to be uploaded to
        $directory = 'public/parts-images/temp';

        // Store the file
        $path = $request->file('image')->store($directory);

        // Resize & encode image
        $image = Image::make(Storage::get($path))->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode();

        // Replace the file with the resized and encoded version
        Storage::put($path, $image);

        // Remove the directory from the path
        $file = str_replace($directory . "/", '', $path);

        // return the name
        return $file;
    }
}
