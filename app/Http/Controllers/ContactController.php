<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Menyimpan pesan kontak yang dikirim dari halaman detail properti.
     */
    public function store(Request $request, Property $property)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string|min:10',
        ]);

        // Simpan pesan kontak ke database
        Contact::create([
            'property_id' => $property->id,
            'marketing_id' => $property->marketing_id, // ID marketing yang akan menerima pesan
            'nama_pengirim' => $validated['nama'],
            'email_pengirim' => $validated['email'],
            'pesan' => $validated['pesan'],
            'status' => 'new', // Status awal pesan
        ]);

        return back()->with('success', 'Pesan Anda berhasil terkirim kepada marketing properti ini.');
    }

    /**
     * Catatan: Untuk melihat pesan kontak, fungsionalitasnya
     * biasanya ada di MarketingController (untuk melihat pesan yang masuk ke dia)
     * atau AdminController (untuk melihat semua pesan).
     */
}