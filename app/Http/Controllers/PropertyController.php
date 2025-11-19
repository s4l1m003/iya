<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; 
use App\Models\Contact;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PropertyController extends Controller
{

    public function index()
    {
        $properties = Property::where('status', 'approved')->latest()->paginate(10);
        
        return view('home', compact('properties'));
    }


    public function show(Property $property)
    {
        if ($property->status !== 'approved') {
            return redirect()->route('home')->with('error', 'Properti tidak ditemukan atau belum disetujui.');
        }

        return view('properties.show', compact('property'));
    }


    public function contact(Request $request, Property $property)
    {
       
        $request->validate([
            'pesan' => 'nullable|string|max:500',
        ]);
        
        
        Contact::create([
            'property_id' => $property->id,
            'marketing_id' => $property->marketing_id, 
            'pelanggan_id' => Auth::id(), 
            'pesan' => $request->pesan,
            'status' => 'pending', 
        ]);


        return back()->with('success', 'Permintaan kontak Anda telah terkirim. Marketing kami akan segera menghubungi Anda.');
    }
}