<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallsignLead extends Model
{
    use HasFactory;

    protected $fillable = ['lead_callsign', 'leader_id',];
}
