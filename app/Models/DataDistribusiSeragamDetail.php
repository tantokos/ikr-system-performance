<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDistribusiSeragamDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'distribusi_id',
        'ukuran',
        'kondisi',
        'jml',
        
    ];
}
