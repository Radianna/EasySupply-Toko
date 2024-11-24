<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'image_name' => 'required|string',
        ]);
    
        $image = $request->file('image');
        $imageName = $request->input('image_name');
    
        // Sanitasi nama file
        $sanitizedImageName = preg_replace('/[^a-zA-Z0-9._-]/', '', $imageName);
    
        // Cek apakah file sudah ada
        $storagePath = 'produk/' . $sanitizedImageName;
        if (Storage::exists($storagePath)) {
            return response()->json([
                'message' => 'Image already exists',
                'path' => Storage::url($storagePath),
            ], 200);
        }
    
        // Simpan file
        $path = $image->storeAs('produk', $sanitizedImageName, 'public');
        return response()->json([
            'message' => 'Image uploaded successfully',
            'path' => Storage::url($path),
        ], 200);
    }
}
