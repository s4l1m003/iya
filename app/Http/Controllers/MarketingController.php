<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class MarketingController extends Controller
{
    // Menampilkan daftar properti yang diupload oleh marketing yang sedang login
    public function index()
    {
        $properties = Property::where('marketing_id', Auth::id())->latest()->get();
        return view('marketing.my_properties', compact('properties'));
    }

    // Menampilkan form upload properti baru
    public function create()
    {
        // Pastikan view 'marketing.upload' ada
        return view('marketing.upload');
    }

    // Menyimpan properti baru
    public function store(Request $request)
    {
        // 1. Validasi data
        $validatedData = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:1000000'],
            'luas_tanah' => ['required', 'numeric', 'min:1'],
            'luas_bangunan' => ['required', 'numeric', 'min:1'],
            'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Max 2MB
        ]);

        // 2. Upload gambar ke storage
        $imagePath = $request->file('gambar')->store('public/properties');
        
        // Hapus 'public/' dari path agar path bisa dibaca oleh asset()
        $imagePath = str_replace('public/', 'storage/', $imagePath);

        // 3. Simpan Properti
        Property::create([
            'judul' => $validatedData['judul'],
            'deskripsi' => $validatedData['deskripsi'],
            'alamat' => $validatedData['alamat'],
            'harga' => $validatedData['harga'],
            'luas_tanah' => $validatedData['luas_tanah'],
            'luas_bangunan' => $validatedData['luas_bangunan'],
            'gambar' => $imagePath, // Simpan path gambar
            'marketing_id' => Auth::id(), // ID Marketing yang sedang login
            'status' => 'pending', // Status awal selalu pending
        ]);

        return Redirect::route('marketing.upload.form')
                        ->with('success', 'Properti berhasil diupload. Menunggu persetujuan Admin/Ketua.');
    }
}