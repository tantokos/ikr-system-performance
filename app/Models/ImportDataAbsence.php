<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDataAbsence extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_karyawan',
        'no_karyawan',
        'area',
        'posisi',
        'unit_organisasi',
        'shift',
        'masuk',
        'keluar',
        'jam_masuk',
        'menit_masuk',
        'jam_keluar',
        'menit_keluar',
        'istirahat_mulai',
        'istirahat_akhir',
        'tipe_hari',
        'actual_work_minutes',
        'menit_lembur',
        'index_lembur',
        'makanan',
        'transport',
        'status',
        'status_lainnya',
        'abs',
        'anl',
        'cst',
        'dif',
        'eai',
        'eao',
        'gvl',
        'lti',
        'mdl',
        'nsi',
        'nso',
        'off',
        'ovh',
        'ovt',
        'pl',
        'prs',
        'sbm',
        'sdc',
        'upl',
        'ot',
        'unpr',
        'permith', 
        'keterangan',
        'import_by'

    ];
}
