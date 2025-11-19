<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    
    public function create(Property $property)
    {
        
        if ($property->status !== 'approved') {
            return redirect()->route('admin.pending')->with('error', 'Properti belum disetujui atau sudah terjual.');
        }

        
        return view('admin.transaction.create', compact('property'));
    }
    public function store(Request $request, Property $property)
    {
       
        $validatedData = $request->validate([
            'harga_jual' => 'required|numeric|min:1000',
            'komisi_persen' => 'required|numeric|min:0|max:100',
            'tanggal_transaksi' => 'required|date',
        ]);

        
        $hargaJual = $validatedData['harga_jual'];
        $komisiPersen = $validatedData['komisi_persen'];
        $komisiMarketing = ($hargaJual * $komisiPersen) / 100;

        
        Transaction::create([
            'property_id' => $property->id,
            'marketing_id' => $property->marketing_id, 
            'tanggal_transaksi' => $validatedData['tanggal_transaksi'],
            'harga_jual' => $hargaJual,
            'komisi_persen' => $komisiPersen,
            'komisi_marketing' => $komisiMarketing,
            'status_pembayaran' => 'pending', 
        ]);
        
        
        $property->update(['status' => 'sold']);

        return redirect()->route('admin.pending')->with('success', 'Transaksi penjualan properti berhasil dicatat dan status properti diubah menjadi SOLD.');
    }
}