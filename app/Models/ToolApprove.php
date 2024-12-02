<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolApprove extends Model
{
    use HasFactory;

    protected $fillable = [
        'br_id',
        'tgl_approve',
        'jenis_approve',
        'status_approve',
        'ket_approve',        
        'login_approve',
    ];
}
