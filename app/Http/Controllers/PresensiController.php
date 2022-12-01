<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->query('id_event');
        if($id){
            $singlePresensi = DB::select('SELECT event.nama_event, mahasiswa.nim, mahasiswa.nama_mahasiswa, presensi.waktu_presensi FROM event, presensi, mahasiswa WHERE event.id_event = presensi.id_event AND presensi.nim = mahasiswa.nim AND presensi.id_event = ?', [$id]);
            $presensi = DB::select('SELECT *, COUNT(presensi.nim) AS jumlah_mahasiswa_hadir FROM event, presensi, mahasiswa WHERE event.id_event = presensi.id_event AND presensi.nim = mahasiswa.nim GROUP BY presensi.id_event');
            $summarySinglePresensi = DB::select('SELECT COUNT(presensi.nim) AS jumlah_mahasiswa_hadir, event.jam_mulai, event.jam_selesai FROM presensi, event WHERE presensi.id_event = event.id_event and presensi.id_event = ? GROUP BY presensi.id_event', [$id]);
            return view('dashboard-admin.presensi.data-presensi',[
                'title' => 'Presensi - Pradita University\'s Guest Lecturers',
                'presensi' => $presensi,
                'singlePresensi' => $singlePresensi,
                'summarySinglePresensi' => $summarySinglePresensi
            ]);
        }else{
            $presensi = DB::select('SELECT *, COUNT(presensi.nim) AS jumlah_mahasiswa_hadir FROM event, presensi, mahasiswa WHERE event.id_event = presensi.id_event AND presensi.nim = mahasiswa.nim GROUP BY presensi.id_event');
            return view('dashboard-admin.presensi.data-presensi',[
                'title' => 'Presensi - Pradita University\'s Guest Lecturers',
                'presensi' => $presensi,
                'singlePresensi' => null,
                'summarySinglePresensi' => null
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
