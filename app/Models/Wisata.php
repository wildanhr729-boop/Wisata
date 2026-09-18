<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = "wisata";
    
    protected $fillable = [
        'nama_wisata',
        'kategori',
        'deskripsi',
        'alamat',
        'foto',
        'latitude',
        'longitude',
        'rating',
        'ulasan',
    ];

    // Tambahkan di sini (sebelum kurung kurawal tutup paling akhir):
    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'wisata_id');
    }
}