<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RootCouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_wo',
        'couse_code',
        'root_couse',
        'action_taken',
        'rootcouse_penagihan',        
        'status_active',
    ];
}
