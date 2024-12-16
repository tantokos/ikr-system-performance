<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDistribusiSeragam extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_distribusi',
        'nik_penerima',
        'nama_penerima',
        'departement',
        'posisi_penerima',
        'posisi_seragam',
        'branch_penerima',
        'nik_distribusi',
        'nama_distribusi',
        'dept_distribusi',
        'posisi_distribusi','posisi_seragam',
        'branch_distribusi',
        'foto_distribusi_seragam',
        'keterangan',
        'login_id',
        'login',
    ];
}
