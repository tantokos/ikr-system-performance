<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPendingReschedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'wo_id',
        'type',
        'wo_no',
        'installation_date',
        'slot_time_leader',
        'reschedule_date',
        'reschedule_time',
        'konfirmasi_cst',
        'konfirmasi_dispatch',
        'keterangan',
        'login_id',
        'login'
    ];
}
