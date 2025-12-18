<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'skripsi_id',
        'dosen_id',
        'catatan',
        'file_surat',
        'status',
    ];

    public function skripsi()
    {
        return $this->belongsTo(Skripsi::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
