<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'tabel_contacts'; // Sesuaikan dengan nama tabel di migrasi

    protected $fillable = [
        'property_id',
        'marketing_id',
        'nama_pengirim',
        'email_pengirim',
        'pesan',
        'status', // new, read, replied
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    
    public function marketing()
    {
        return $this->belongsTo(User::class, 'marketing_id');
    }
}