<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Validasi request
        $request->validate([
            'image' => 'required|image|max:2048', // File harus berupa gambar dengan ukuran maksimal 2MB
        ]);
    
        // Simpan file ke storage
        $path = $request->file('image')->store('images'); // Folder 'images' di storage Laravel
    
        // Respon ke client
        return response()->json([
            'message' => 'Image uploaded successfully',
            'path' => $path,
        ], 200);
    }
}
