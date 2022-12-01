<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardUserController extends Controller
{
    public function index()
    {
        $event = DB::select('SELECT COUNT(id_event) AS jumlah_kuliah_tamu FROM event');
        $mahasiswa = DB::select('SELECT COUNT(nim) AS jumlah_mahasiswa FROM mahasiswa');
        $posts = DB::select('SELECT COUNT(id_posts) AS jumlah_post FROM posts');
        $dokumentasi = DB::select('SELECT COUNT(id_dokumentasi) AS jumlah_dokumentasi FROM dokumentasi');

        // $user = DB::select('SELECT * FROM users, role WHERE users.id_role = role.id_role AND users.id = ?', [auth()->user()->id]);

        // dd(auth()->user());
        return view('website-for-user.about.index',[
            'title' => 'Dashboard User - Pradita University\'s Guest Lecturers',
            'event' => $event,
            'mahasiswa' => $mahasiswa,
            'posts' => $posts,
            'dokumentasi' => $dokumentasi,

        ]);
    }
}
