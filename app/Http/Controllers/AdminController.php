<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; // Pastikan Model Property di-import dengan benar
use App\Models\User; // Asumsi jika ingin menampilkan nama marketing

class AdminController extends Controller
{
    // Method yang dipanggil oleh route admin.pending (route('admin.pending'))
    public function pendingProperties()
    {
        // Ambil semua properti dengan status 'pending'
        // Jika Anda ingin mengikutkan data user marketing:
        $properties = Property::where('status', 'pending')
                             ->latest()
                             ->get(); // Hapus ->paginate() jika tidak ingin pagination

        // PASTIKAN VIEW YANG DIPANGGIL ADALAH VIEW KHUSUS ADMIN, BUKAN 'welcome'
        return view('admin.pending', compact('properties'));
    }

    // Method untuk menyetujui properti
    public function approve(Property $property)
    {
        $property->status = 'approved';
        $property->save();

        return back()->with('success', 'Properti berhasil disetujui dan kini tampil di katalog.');
    }

    // Method untuk menolak properti
    public function reject(Property $property)
    {
        $property->status = 'rejected';
        $property->save();
        
        return back()->with('success', 'Properti berhasil ditolak.');
    }
}