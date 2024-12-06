<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDisposalTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_disposal',
        'tgl_disposal',
        'tool_id',
        'foto_disposal',
        'login_id',
        'login'
    ];
}
