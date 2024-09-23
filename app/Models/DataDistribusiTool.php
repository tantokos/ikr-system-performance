<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDistribusiTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_distribusi',
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
        'status_distribusi',
        'keterangan',
        'foto_data_tool',
        'foto_distribusi',
        'login_id',
        'login',
        'approve_nik',
        'approve_spv',
        'approve_date'
    ];
}
