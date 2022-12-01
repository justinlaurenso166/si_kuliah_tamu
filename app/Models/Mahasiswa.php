<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'jenis_kelamin',
        'prodi',
        'angkatan',
        'id_users'
    ];
}
