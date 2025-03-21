<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FtthDismantle extends Model
{
    use HasFactory;

    protected $table = "data_ftth_dismantle_oris";
    protected $fillable = [
        'no_wo',
        'wo_date',
        'visit_date',
        'dis_port_date',
        'takeout_notakeout',
        'port',
        'close_date',
        'cust_id',
        'nama_cust',
        'cust_address',
        'slot_time',
        'teknisi1',
        'teknisi2',
        'teknisi3',
        'start',
        'finish',
        'kode_fat',
        'kode_area',
        'cluster',
        'kotamadya',
        'kotamadya_penagihan',
        'penagihan',
        'tgl_dismantle_port',
        'main_branch',
        'material_in',
        'ms_regular',
        'fat_status',
        'ont_sn_in',
        'stb_sn_in',
        'router_sn_in',
        'tarik_cable',
        'status_wo',
        'reason_status',
        'action_status',
        'remarks',
        'reschedule_date',
        'reschedule_time',
        'alasan_no_rollback',
        'detail_alasan',
        'callsign',
        'checkin_apk',
        'checkout_apk',
        'selisih_menit',
        'status_checkin',
        'waktu_instalasi',
        'status_apk',
        'keterangan',
        'ikr_progress_date',
        'ikr_report_date',
        'reconsile_date',
        'weather',
        'leader',
        'pic_dispatch',
        'telp_dispatch',
        'pic_monitoring',
        'login',
        'is_checked',
        'created_at',
        'updated_at'
    ];
}
