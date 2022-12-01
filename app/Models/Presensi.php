<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table= 'presensi';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'waktu_presensi',
        'id_event'
    ];
}
