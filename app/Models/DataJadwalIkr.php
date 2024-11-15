<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJadwalIkr extends Model
{
    use HasFactory;

    protected $table = 'data_jadwal_ikrs';
    protected $fillable = [
        'branch_id',
        'branch',
        'nik_karyawan',
        'nama_karyawan',
        'bulan',
        'tahun',
        't01','t02','t03','t04','t05','t06','t07','t08','t09','t10',
        't11','t12','t13','t14','t15','t16','t17','t18','t19','t20',
        't21','t22','t23','t24','t25','t26','t27','t28','t29','t30','t31','login_id','login','created_at','updated_at'];

}
