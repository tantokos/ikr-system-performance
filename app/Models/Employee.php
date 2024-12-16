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
        'seragam1',
        'seragam2',
        'seragam3',
        'no_ktp',
        'no_npwp',
        'no_rek',
        'no_bpjs',
        'no_jamsostek',
        'foto_karyawan',
        'kewarganegaraan',
        'status_pernikahan',
        'jml_tanggungan',
        'email_pribadi',
        'alamat_domisili',
        'pendidikan_terakhir',
        'golongan_darah',
        'no_koperasi',
        'nama_kel',
        'status_kel',
        'alamat_kel',
        'pekerjaan_kel',
        'no_telp_kel',
        'anak1',
        'anak2',
        'anak3',
        'anak4',
        'nama_kontak1',
        'status_kontak1',
        'alamat_kontak1',
        'no_telp_kontak1',
        'nama_kontak2',
        'status_kontak2',
        'alamat_kontak2',
        'no_telp_kontak2',
        'input_by',
        'update_by',
    ];
}
