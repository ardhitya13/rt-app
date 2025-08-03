<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'isi', 'warga_id'];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
