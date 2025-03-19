<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPoDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_pengajuan',
        'br_id',
        'nama_br',
        'merk_br',
        'satuan_br',
        'spesifikasi_br',
        'qty',
        'periode',
        'start_date',
        'harga',
        'login'
    ];
}
