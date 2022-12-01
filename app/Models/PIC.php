<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PIC extends Model
{
    use HasFactory;
    protected $table= 'pic';
    public $timestamps = false;

    protected $fillable = [
        'nama_dosen',
        'prodi'
    ];
}
