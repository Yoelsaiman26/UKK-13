<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $guarded = [];

    protected $table = 'siswas';
    
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
