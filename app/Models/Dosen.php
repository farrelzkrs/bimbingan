<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosens';

    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'spesialisasi',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skripsis()
    {
        return $this->hasMany(Skripsi::class);
    }

    // Backward compatibility
    public function proyeks()
    {
        return $this->skripsis();
    }
}
