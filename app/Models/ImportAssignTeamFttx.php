<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportAssignTeamFttx extends Model
{
    use HasFactory;

    protected $table = 'import_assign_team_fttx';

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
        'branch',
        'leader',
        'callsign',
        'tim_1',
        'tim_2',
        'tim_3',
        'nopol',
        'perubahan_slot_time_tele',
        'checkin',
        'checkout',
        'status_wo',
        'keterangan_wo',
        'login_id',
        'login',
    ];
}
