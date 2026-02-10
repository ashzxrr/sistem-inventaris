<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'satuan',
        'keterangan'
    ];

    public function mutasis()
    {
        return $this->hasMany(Mutasi::class);
    }

    // stok otomatis (MASUK - KELUAR)
    public function getStokAttribute()
    {
        $masuk = $this->mutasis()->where('jenis', 'MASUK')->sum('jumlah');
        $keluar = $this->mutasis()->where('jenis', 'KELUAR')->sum('jumlah');

        return $masuk - $keluar;    
    }
}