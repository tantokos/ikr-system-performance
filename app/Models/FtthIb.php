<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FtthIb extends Model
{
    use HasFactory;

    protected $table = 'data_ftth_ib_oris';

    protected $fillable = [
        'pic_monitoring',
        'site',
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
        'branch_id',
        'branch',
        'leadcall_id',
        'leadcall',
        'tgl_ikr',
        'slot_time_leader',
        'slot_time_apk',
        'sesi',
        'callsign',
        'leader_id',
        'leader',
        'tek1_nik',
        'tek2_nik',
        'tek3_nik',
        'teknisi1',
        'teknisi2',
        'teknisi3',
        'status_wo',
        'reason_status',
        'penagihan',
        'tgl_jam_reschedule',
        'tgl_reschedule',
        'alasan_cancel',
        'alasan_pending',
        'respon_konf_cst',
        'permintaan_reschedule',
        'weather',
        'start_ikr_wa',
        'end_ikr_wa',
        'nama_dispatch',
        'telp_dispatch',
        'jam_tek_foto_rmh',
        'jam_dispatch_respon_foto',
        'jam_teknisi_cek_fat',
        'jam_dispatch_respon_fat',
        'jam_teknisi_cek_port_fat',
        'jam_dispatch_respon_port_fat',
        'jam_teknisi_aktifasi_perangkat',
        'jam_dispatch_respon_aktifasi_perangkat',
        'validasi_start',
        'validasi_end',
        'otp_start',
        'otp_end',
        'checkin_apk',
        'checkout_apk',
        'status_apk',
        'keterangan',
        'ms_regular',
        'wo_date_apk',
        'wo_date_mail_reschedule',
        'wo_date_slot_time_apk',
        'slot_time_assign_apk',
        'slot_time_apk_delay',
        'status_slot_time_apk_delay',
        'ket_delay_slot_time',
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
        'kabel_utp',
        'fast_connector',
        'patchcord',
        'pipa',
        'socket_pipa',
        'terminal_box',
        'cable_duct',
        'remote_fiberhome',
        'remote_extrem',
        'port_fat',
        'marker',
        'site_penagihan',
        'login',
    ];
}