<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';
    protected $fillable = [
        'peminjaman_id',
        'tanggal_pengembalian',
        'kondisi_alat',
        'catatan',
        'denda',
    ];

    protected $casts = [
        'tanggal_pengembalian' => 'date',
    ];

    // Relationships
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
