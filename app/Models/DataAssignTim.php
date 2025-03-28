<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAssignTim extends Model
{
    use HasFactory;

    protected $table = 'data_assign_tims';

    protected $fillable = [
        'batch_wo',
        'tgl_ikr',
        'slot_time',
        'type_wo',
        'no_wo_apk',
        'no_ticket_apk',
        'wo_date_apk',
        'cust_id_apk',
        'name_cust_apk',
        'cust_phone_apk',
        'cust_mobile_apk',
        'address_apk',
        'area_cluster_apk',
        'wo_type_apk',
        'fat_code_apk',
        'fat_port_apk',
        'remarks_apk',
        'vendor_installer_apk',
        'ikr_date_apk',
        'time_apk',
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
        'login',
        'cek_telebot',
        'status_telebot',
        // 'is_broadcast_sent',
    ];
}
