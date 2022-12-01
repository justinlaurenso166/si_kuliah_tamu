<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsDanDokumentasi extends Model
{
    use HasFactory;
    protected $table= 'posts_dan_dokumentasi';
    public $timestamps = false;

    protected $fillable = [
        'id_posts',
        'id_dokumentasi'
    ];
}
