<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJadwalIkrEdit extends Model
{
    use HasFactory;

    protected $table = 'data_jadwal_ikr_edits';
    protected $fillable = [
        'jadwal_id',
        'branch_id',
        'branch',
        'nik_karyawan',
        'nama_karyawan',
        'bulan',
        'tahun',
        'tgl_jadwal',
        'jadwal_before',
        'status_jadwal',
        'keterangan',
        'foto_lampiran',
        'login_id','login','created_at','updated_at'];
}
