<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $fillable = [
        'barang_id',
        'jenis',
        'jumlah',
        'penanggung_jawab',
        'tanggal',
        'keterangan'
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

}
