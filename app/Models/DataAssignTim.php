<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAssignTim extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_wo',
        'tgl_ikr',
        'slot_time',
        'jenis_wo',
        'wo_no',
        'ticket_no',
        'wo_date',
        'cust_id',
        'name',
        'cust_phone',
        'cust_mobile',
        'address',
        'area',
        'wo_type',
        'fat_code',
        'fat_port',
        'remarks',
        'vendor_installer',
        'ikr_date',
        'time',
        'branch_id',
        'branch',
        'leadcall_id',
        'leadcall',
        'leader_id',
        'leader',
        'callsign_id',
        'callsign',
        'tek1_nik',
        'teknisi1',
        'tek2_nik',
        'teknisi2',
        'tek3_nik',
        'teknisi3',
        'tek4_nik',
        'teknisi4',
        'login_id',
        'login'

    ];
}
