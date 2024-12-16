<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSeragam extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'branch_seragam',
        'posisi_seragam',
        'nik_teknisi',
        'ukuran',
        'kondisi',
        'jml',
    ];
}
