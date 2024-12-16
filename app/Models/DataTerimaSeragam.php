<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTerimaSeragam extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_terima',
        'nik_penerima',
        'nama_penerima',
        'departement',
        'posisi_penerima',
        'posisi_seragam',
        'branch_penerima',
        'foto_terima_seragam',
        'keterangan',
        'login_id',
        'login',
    ];
}
