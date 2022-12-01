<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembicaraDanEvent extends Model
{
    use HasFactory;
    protected $table= 'pembicara_dan_event';
    public $timestamps = false;

    protected $fillable = [
        'id_pembicara',
        'id_event',
        'sertifikat'
    ];
}
