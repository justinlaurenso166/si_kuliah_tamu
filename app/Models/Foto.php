<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $table= 'foto';
    public $timestamps = false;

    protected $fillable = [
        'foto',
        'id_dokumentasi'
    ];
}
