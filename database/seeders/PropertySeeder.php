<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property; 
use App\Models\User;     
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        $marketingUser = DB::table('users')->where('role', 'marketing')->first();
        $marketingId = $marketingUser ? $marketingUser->id : 4; // Default ID 4 jika tidak ditemukan

        Property::create([
            'marketing_id' => $marketingId,
            'judul' => 'Rumah Elit Citraland',
            'deskripsi' => 'Rumah baru dua lantai, lokasi premium, dekat fasilitas umum.',
            'harga' => 3500000000, 
            'alamat' => 'Jl. Boulevard Raya No. 10, Citraland',
            'luas_tanah' => 150,
            'luas_bangunan' => 200,
            'gambar' => 'properties/citraland_elite.jpg', 
            'status' => 'approved', 
            'tanggal_upload' => now(),
            'approved_by' => 1, 
        ]);

        Property::create([
            'marketing_id' => $marketingId,
            'judul' => 'Tanah Kavling Investasi',
            'deskripsi' => 'Tanah strategis di jalur utama, cocok untuk ruko atau gudang.',
            'harga' => 950000000,
            'alamat' => 'Jalan Bypass KM 5, Pinggiran Kota',
            'luas_tanah' => 500,
            'luas_bangunan' => 0, 
            'gambar' => 'properties/kavling_bypass.jpg',
            'status' => 'pending', 
            'tanggal_upload' => now(),
        ]);
        
    }
}
