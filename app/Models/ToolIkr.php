<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolIkr extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'merk_barang',
        'spesifikasi',
        'kode_aset',
        'kode_ga',
        'kondisi',
        'satuan',
        'jumlah',
        'kategori',
        'tgl_pengadaan',
        'foto_barang',
        'tgl_beli',
        'nopol',
        'pajak_1tahun',
        'pajak_5tahun',
        'nik_penerima',
        'nama_penerima',
        'branch_penerima',
        'posisi',
        'approve1',
        'approve2',
        'login',
        'status_distribusi'

    ];
}
