<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listFat extends Model
{
    use HasFactory;

    protected $table = 'list_fat';
    
    protected $fillable = [
        'kode_area',
        'cluster',
        'kotamadya',
        'branch',
        'kotamadya_penagihan',        
        'site',
        'kategori_area'
    ];
}
