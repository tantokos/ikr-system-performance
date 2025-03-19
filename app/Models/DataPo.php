<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPo extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_pengajuan',
        'tgl',
        'cost_center',
        'branch',
        'category',
        'no_vendor',
        'br_id',
        'qty',
        'harga',
        'login',
        'updateby'
    ];
}
