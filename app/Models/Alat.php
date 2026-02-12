<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alats';
    protected $fillable = [
        'nama',
        'deskripsi',
        'kategori_id',
        'stok',
        'stok_tersedia',
        'nomor_seri',
        'kondisi',
    ];

    // Relationships
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
