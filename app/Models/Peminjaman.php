<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = [
        'user_id',
        'alat_id',
        'jumlah',
        'tanggal_peminjaman',
        'tanggal_kembali_rencana',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_peminjaman' => 'date',
        'tanggal_kembali_rencana' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }
}
