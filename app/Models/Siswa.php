<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Siswa extends Model
{
    protected $guarded = [];

    protected $casts = [
        'tgl_lahir' => 'datetime',
    ];

    protected $table = 'siswas';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
