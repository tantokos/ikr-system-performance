<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FtthMaterial extends Model
{
    use HasFactory;

    protected $table = 'ftth_materials';

    protected $fillable = [
        'wo_no',
        'wo_date',
        'installation_date',
        'vendor_installer',
        'callsign',
        'area',
        'warehouse',
        'cust_id',
        'name',
        'wo_type',
        'remarks',
        'status',
        'status_item',
        'item_code',
        'description',
        'qty',
        'sn',
        'mac_address',
        'material_condition'
    ];
}
