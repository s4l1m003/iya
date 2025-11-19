<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    
    public function pending()
    {
        
        $properties = Property::with('marketing')->where('status', 'pending')->latest()->get();
        
        return view('admin.pending_list', compact('properties'));
    }


    public function approve(Property $property)
    {
        $property->update([
            'status' => 'approved',
            'approved_by' => Auth::id(), 
        ]);
        
        return redirect()->route('admin.pending')->with('success', 'Properti berhasil disetujui dan telah tayang di katalog.');
    }
    
    
    public function destroy(Property $property)
    {
        
        if ($property->gambar) {
             
            \Illuminate\Support\Facades\Storage::disk('public')->delete($property->gambar);
        }
        
        $property->delete();
        
        return redirect()->route('admin.pending')->with('success', 'Properti berhasil ditolak/dihapus dari sistem.');
    }


    public function sold(Property $property)
    {
        $property->update(['status' => 'sold']);
        return back()->with('success', 'Status properti berhasil diubah menjadi SOLD.');
    }
    
    
    public function commissionReport()
    {
        
        return view('pajak.report');
    }
}