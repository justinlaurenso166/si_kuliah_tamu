<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $event = DB::select('SELECT COUNT(id_event) AS jumlah_kuliah_tamu FROM event');
        $mahasiswa = DB::select('SELECT COUNT(nim) AS jumlah_mahasiswa FROM mahasiswa');
        $posts = DB::select('SELECT COUNT(id_posts) AS jumlah_post FROM posts');
        $dokumentasi = DB::select('SELECT COUNT(id_dokumentasi) AS jumlah_dokumentasi FROM dokumentasi');
        return view('dashboard-admin.dashboard.index',[
            'title' => 'Dashboard Admin - Pradita University\'s Guest Lecturers',
            'event' => $event,
            'mahasiswa' => $mahasiswa,
            'posts' => $posts,
            'dokumentasi' => $dokumentasi,
        ]);
    }
}
