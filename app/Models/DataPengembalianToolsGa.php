<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengembalianToolsGa extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_pengadaan',
        'tgl_kembali',
        'barang_id',
        'nama_barang',
        'merk_barang',
        'kondisi',
        'satuan',
        'kode_aset',
        'kode_ga',
        'spesifikasi',
        'status_pengembalian',
        'keterangan',
        'nik_pengembalian',
        'nama_pengembalian',
        'foto_data_tool',
        'foto_kembali',
        'login_id',
        'login'
    ];
}
