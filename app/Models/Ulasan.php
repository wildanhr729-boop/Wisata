<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $fillable = ['wisata_id', 'nama_pengunjung', 'rating', 'komentar'];

    public function wisata()
    {
        return $table->belongsTo(Wisata::class, 'wisata_id');
    }
}