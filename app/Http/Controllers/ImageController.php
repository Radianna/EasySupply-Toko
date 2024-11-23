<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        // Validasi request
        $request->validate([
            'image' => 'required|image|max:2048', // File harus berupa gambar dengan ukuran maksimal 2MB
            'image_name' => 'required|string', // Nama file yang akan digunakan (dari proyek A)
        ]);
      
        // Ambil file dari request
        $image = $request->file('image');
        $imageName = $request->input('image_name'); // Nama file dari proyek A
      
        // Pastikan nama file valid (misalnya, menghindari karakter yang tidak diizinkan)
        $sanitizedImageName = preg_replace('/[^a-zA-Z0-9._-]/', '', $imageName);
      
        // Cek apakah file dengan nama yang sama sudah ada di dalam storage
        $existingFile = storage_path('app/public/produk/' . $sanitizedImageName);
        if (file_exists($existingFile)) {
            // Jika file sudah ada, langsung kembalikan URL file yang sudah ada
            $fileUrl = Storage::url('produk/' . $sanitizedImageName);
          
            return response()->json([
                'message' => 'Image already exists',
                'path' => $fileUrl, // Path yang sudah ada
            ], 200);
        }
      
        // Simpan file ke storage/public/produk dengan nama dari proyek A
        $path = $image->storeAs('produk', $sanitizedImageName, 'public');
      
        // Mengubah path file agar dapat diakses dari public storage
        $fileUrl = Storage::url($path);
      
        // Respon ke client
        return response()->json([
            'message' => 'Image uploaded successfully',
            'path' => $fileUrl, // Path yang sudah dapat diakses melalui URL
        ], 200);
    }
}
