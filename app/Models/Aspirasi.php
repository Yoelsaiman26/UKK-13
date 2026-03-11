<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $guarded = [];

    protected $table = 'aspirasis';

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
