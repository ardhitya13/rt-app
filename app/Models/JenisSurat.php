<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSurat extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'keterangan'];

    public function pengajuansurat()
    {
        return $this->hasMany(PengajuanSurat::class);
    }
}
