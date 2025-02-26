<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportKonfCst extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'id',
        'timestamp',
        'pic',
        'tgl_progress',
        'branch',
        'type_wo',
        'no_wo',
        'id_cust',
        'nama_cust',
        'slot_time_leader',
        'no_telp_cst',
        'bukti_konfirmasi',
        'tgl_konfirmasi',
        'jam_konfirmasi',
        'status_konfirmasi',
        'login'
    ];
}
