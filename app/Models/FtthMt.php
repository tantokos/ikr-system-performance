<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FtthMt extends Model
{
    use HasFactory;

    protected $table = 'data_ftth_mt_oris';
    protected $fillable = [
        'pic_monitoring',
        'type_wo',
        'no_wo',
        'no_ticket',
        'cust_id',
        'nama_cust',
        'cust_address1',
        'cust_address2',
        'type_maintenance',
        'kode_fat',
        'kode_wilayah',
        'cluster',
        'kotamadya',
        'kotamadya_penagihan',
        'branch',
        'tgl_ikr',
        'slot_time_leader',
        'slot_time_apk',
        'sesi',
        'remark_traffic',
        'callsign',
        'leader',
        'teknisi1',
        'teknisi2',
        'teknisi3',
        'status_wo',
        'couse_code',
        'root_couse',
        'penagihan',
        'alasan_tag_alarm',
        'tgl_jam_reschedule',
        'tgl_reschedule',
        'tgl_jam_fat_on',
        'action_taken',
        'panjang_kabel',
        'weather',
        'remark_status',
        'action_status',
        'visit_novisit',
        'start_ikr_wa',
        'end_ikr_wa',
        'validasi_start',
        'validasi_end',
        'checkin_apk',
        'checkout_apk',
        'status_apk',
        'keterangan',
        'ms_regular',
        'wo_date_apk',
        'wo_date_mail_reschedule',
        'wo_date_slot_time_apk',
        'actual_sla_wo_minute_apk',
        'actual_sla_wo_jam_apk',
        'mttr_over_apk_minute',
        'mttr_over_apk_jam',
        'mttr_over_apk_persen',
        'status_sla',
        'root_couse_before',
        'slot_time_assign_apk',
        'slot_time_apk_delay',
        'ket_delay_slot_time',
        'konfirmasi_customer',
        'ont_merk_out',
        'ont_sn_out',
        'ont_mac_out',
        'ont_merk_in',
        'ont_sn_in',
        'ont_mac_in',
        'router_merk_out',
        'router_sn_out',
        'router_mac_out',
        'router_merk_in',
        'router_sn_in',
        'router_mac_in',
        'stb_merk_out',
        'stb_sn_out',
        'stb_mac_out',
        'stb_merk_in',
        'stb_sn_in',
        'stb_mac_in',
        'dw_out',
        'precon_out',
        'bad_precon',
        'fast_connector',
        'patchcord',
        'terminal_box',
        'remote_fiberhome',
        'remote_extrem',
        'port_fat',
        'site_penagihan',
        'konfirmasi_penjadwalan',
        'konfirmasi_cst',
        'konfirmasi_dispatch',
        'remark_status2',
        'login',
        'created_at',
        'updated_at',
        'wo_type_apk',
        'branch_id',
        'leadcall',
        'tek1_nik',
        'tek2_nik',
        'tek3_nik',
        'tek4_nik',
        'leadcall_id',
        'leader_id',
        'callsign_id',
        'teknisi4',
        'alasan_tidak_ganti_precon',
        'alasan_pending',
        'alasan_cancel',
        'report_teknisi',
    ];
}
