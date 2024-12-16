<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTerimaSeragamDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'penerimaan_id',
        'ukuran',
        'kondisi',
        'jml',
        'login_id',
        'login',
    ];
}
