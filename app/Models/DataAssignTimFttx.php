<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAssignTimFttx extends Model
{
    use HasFactory;

    protected $table = 'data_assign_tim_fttxs';

    protected $fillable = [
        'no_so',
        'so_date',
        'customer_name',
        'address',
        'pic_customer',
        'phone_pic_cust',
        'wo_type',
        'product',
        'remark_ewo',
        'cid',
        'segment_sales',
        'area',
        'jadwal_ikr',
        'slot_time_jadwal',
        'remark_for_ikr',
        'status_penjadwalan',
        'vendor',
        'branch_id',
        'branch',
        'leadcall_id',
        'leadcall',
        'leader_id',
        'leader',
        'callsign_id',
        'callsign',
        'tek1_nik',
        'tim_1',
        'tek2_nik',
        'tim_2',
        'tek3_nik',
        'tim_3',
        'tek4_nik',
        'tim_4',
        'nopol',
        'perubahan_slot_time_tele',
        'checkin',
        'checkout',
        'status_wo',
        'keterangan_wo',
        'login_id',
        'login',
        'created_at',
        'updated_at',
    ];

}
