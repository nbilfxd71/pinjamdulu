<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasLog extends Model
{
    protected $table = 'aktivitas_logs';
    protected $fillable = [
        'user_id',
        'aksi',
        'entitas',
        'entitas_id',
        'detail',
        'ip_address',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
