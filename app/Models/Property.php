<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    // WAJIB: Tentukan nama tabel yang non-standar (sesuai database Anda)
    protected $table = 'properties';

    /**
     * The attributes that are mass assignable.
     * Pastikan semua kolom yang diisi di Seeder/Controller ada di sini.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'status',          // Dari migration Anda (pending, approved, sold)
        'marketing_id',    // Kunci asing
        'judul',
        'deskripsi',
        'harga',
        'alamat',
        'luas_tanah',
        'luas_bangunan',
        'gambar',          // Untuk menyimpan nama file gambar
    ];

    /**
     * Relasi dengan user (marketing) yang mengupload properti.
     */
    public function marketing()
    {
        // Asumsi relasi ke Model User
        return $this->belongsTo(User::class, 'marketing_id');
    }

    // Anda bisa menambahkan relasi lain di sini jika diperlukan
}