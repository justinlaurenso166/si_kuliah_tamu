<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\Event;
use Illuminate\Http\Request;
// use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\DB;

class DokumentasiUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search) {
            $allDokumentasi = DB::select('SELECT DISTINCT(dokumentasi.id_dokumentasi), foto.*, event.*
            FROM dokumentasi
            INNER JOIN foto ON foto.id_foto =
            (SELECT foto.id_foto FROM foto WHERE dokumentasi.id_dokumentasi = foto.id_dokumentasi ORDER BY foto.id_dokumentasi ASC LIMIT 1 ), event WHERE event.id_event = dokumentasi.id_event AND event.nama_event LIKE ? ORDER BY dokumentasi.id_dokumentasi ASC', ['%' . $search . '%']);
            $total = count($allDokumentasi);
            $per_page = 6;
            $current_page = $request->input("page") ?? "1";
            $starting_point = ($current_page * $per_page) - $per_page;
            $dokumentasiSlice = array_slice($allDokumentasi, $starting_point, $per_page, false);
            $dokumentasi = new Paginator($dokumentasiSlice, $total, $per_page, $current_page,['path' => $request->url(), 'query' => $request->query()]);
            $dokumentasi->setPath('documentation');
            return view('website-for-user.documentation.documentation',[
                'title' => 'Dokumentasi - Pradita University\'s Guest Lecturers',
                'dokumentasi' => $dokumentasi,
            ]);
        }
        $allDokumentasi = DB::select('SELECT DISTINCT(dokumentasi.id_dokumentasi), foto.*, event.*
        FROM dokumentasi
        INNER JOIN foto ON foto.id_foto =
        (SELECT foto.id_foto FROM foto WHERE dokumentasi.id_dokumentasi = foto.id_dokumentasi ORDER BY foto.id_dokumentasi ASC LIMIT 1 ), event WHERE event.id_event = dokumentasi.id_event ORDER BY dokumentasi.id_dokumentasi ASC ');
        $total = count($allDokumentasi);
        $per_page = 6;
        $current_page = $request->input("page") ?? "1";
        $starting_point = ($current_page * $per_page) - $per_page;

        $dokumentasiSlice = array_slice($allDokumentasi, $starting_point, $per_page, false);
        $dokumentasi = new Paginator($dokumentasiSlice, $total, $per_page, $current_page,['path' => $request->url(), 'query' => $request->query()]);
        //https://stackoverflow.com/questions/27213453/laravel-5-manual-pagination


        // dd($dokumentasi);
        // dd($starting_point);
        // dd($current_page);
        // dd($dokumentasi->links());
        // dd($dokumentasi->onEachSide);
        // $dokumentasi = new Paginator($allDokumentasi, $total, $per_page, $current_page, [
        //     'path' => $request->url(),
        //     'query' => $request->query(),
        // ]);


        $dokumentasi->setPath('documentation');
        return view('website-for-user.documentation.documentation',[
            'title' => 'Dokumentasi - Pradita University\'s Guest Lecturers',
            'dokumentasi' => $dokumentasi,
        ]);
    }

    public function show($id)
    {
        $dokumentasi = DB::select('SELECT DISTINCT(dokumentasi.id_dokumentasi), dokumentasi.*, foto.*, event.* FROM dokumentasi, foto , event WHERE event.id_event = dokumentasi.id_event AND dokumentasi.id_dokumentasi = foto.id_dokumentasi AND dokumentasi.id_dokumentasi = ?',[$id]);
        return view('website-for-user.documentation.documentation-inside',[
            'title' => 'Dokumentasi - Pradita University\'s Guest Lecturers',
            'dokumentasi' => $dokumentasi,
        ]);
    }
}
