<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'angkatan',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skripsi()
    {
        return $this->hasOne(Skripsi::class);
    }

    // Backward compatibility
    public function proyek()
    {
        return $this->skripsi();
    }
}
