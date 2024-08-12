<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik_karyawan',
        'nama_karyawan',
        'alamat',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'agama',
        'no_telp',
        'tgl_gabung',
        'status_pegawai',
        'status_active',
        'tgl_nonactive',
        'branch_id',
        'divisi',
        'departement',
        'posisi',
        'email',
        'no_ktp',
        'no_npwp',
        'no_rek',
        'no_bpjs',
        'no_jamsostek',
        'foto_karyawan',
        'kelengkapan',
        'input_by',
        'update_by',
    ];
}
