<?php

namespace App\Models;

use App\Models\Pembicara;
use Illuminate\Support\Str;
use function PHPSTORM_META\type;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $table= 'event';
    public $timestamps = false;

    protected $fillable = [
        'nama_event',
        'cara_pelaksanaan',
        'background',
        'flyer',
        'tempat_pelaksanaan',
        'link',
        'tanggal_pelaksanaan',
        'jam_mulai',
        'jam_selesai',
        'id_pic',
        'id_proposal',
        'laporan_akhir'
    ];

    public function pembicara()
    {
        return $this->belongsToMany(Pembicara::class, 'pembicara_dan_event', 'id_event', 'id_pembicara', 'id_event', 'id_pembicara');
    }

    public function scopeFilter($query, Array $filters)
    {
        $query->when( $filters['search'] ?? false, function($query, $search)
        {
            return $query->where(function($query) use ($search) {
                $query->where('nama_event', 'LIKE', '%' . $search . '%')
                            ->orWhere('cara_pelaksanaan', 'LIKE', '%' . $search . '%')
                            ->orWhere('tempat_pelaksanaan', 'LIKE', '%' . $search . '%');
            });
        });
        $query->when( $filters['date_search'] ?? false, function($query, $search)
        {
            return $query->where(function($query) use ($search) {
                $startDate = strtotime(Str::substr($search,0, 10));
                $startDate = date('Y-m-d', $startDate);
                $endDate = strtotime(Str::substr($search, 13, 10));
                $endDate = date('Y-m-d', $endDate);
                $query->whereBetween('tanggal_pelaksanaan', [$startDate, $endDate]);
            });
        });
    }
}
