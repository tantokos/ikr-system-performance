<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportFtthMtApk extends Model
{
    use HasFactory;

    protected $fillable = [
        'wo_no',
        'ticket_no',
        'wo_date',
        'installation_date',
        'time',
        'vendor_installer',
        'callsign',
        'cust_id',
        'name',
        'cust_phone',
        'cust_mobile',
        'address',
        'area',
        'wo_type',
        'cause_code',
        'root_cause',
        'action_taken',
        'fat_code',
        'fat_port',
        'remarks',
        'status',
        'pending',
        'reason',
        'check_in',
        'check_out',
        'mttr_all',
        'mttr_pending',
        'mttr_progress',
        'mttr_technician',
        'sla_over',
    ];
}
