<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;
    protected $table= 'dokumentasi';
    public $timestamps = false;

    protected $fillable = [
        'video',
        'feedback',
        'id_event'
    ];
}
