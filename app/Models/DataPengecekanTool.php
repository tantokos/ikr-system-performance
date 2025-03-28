<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengecekanTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_dis',
        'tgl_pengecekan',
        'barang_id',
        'nama_barang',
        'merk_barang',
        'kondisi',
        'satuan',
        'kode_aset',
        'kode_ga',
        'spesifikasi',
        'leadcall_id',
        'lead_callsign',
        'leader_id',
        'leader',
        'posisi',
        'callsign_tim_id',
        'callsign_tim',
        'area',
        'nik_tim1',
        'teknisi1',
        'nik_tim2',
        'teknisi2',
        'nik_tim3',
        'teknisi3',
        'nik_tim4',
        'teknisi4',
        'status_pengecekan',
        'keterangan',
        'foto_pengecekan',
        'login_id',
        'login'
    ];
}
