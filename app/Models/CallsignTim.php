<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallsignTim extends Model
{
    use HasFactory;

    protected $fillable = ['callsign_tim', 'nik_tim1', 'nik_tim2', 'nik_tim3', 'nik_tim4', 'lead_callsign'];
}
