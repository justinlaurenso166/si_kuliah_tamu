<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table= 'proposal';
    public $timestamps = false;

    protected $fillable = [
        'mata_kuliah',
        'latar_belakang',
        'tujuan_kegiatan',
        'file_proposal'
    ];
}
