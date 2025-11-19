<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'tabel_property'; 

    protected $fillable = [
        'marketing_id',
        'judul',
        'deskripsi',
        'harga',
        'alamat',
        'luas_tanah',
        'luas_bangunan',
        'gambar',
        'status', 
        'tanggal_upload',
        'approved_by',
    ];

    public function marketing()
    {
        return $this->belongsTo(User::class, 'marketing_id', 'id');
    }
}