<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Presensi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventUserController extends Controller
{
    public function index()
    {
        // DB::enableQueryLog();
        $event = Event::filter(request(['search','date_search']))->paginate(5)->withQueryString();
        // $quries = DB::getQueryLog();
        // dd($quries);
        return view('website-for-user.event.event',[
            'title' => 'Event - Pradita University\'s Guest Lecturers',
            'event' => $event,
        ]);
    }

    public function show($id)
    {
        $pembicara = DB::select('SELECT pembicara.*, event.id_event, pembicara.nama, event.nama_event, event.cara_pelaksanaan, event.tempat_pelaksanaan, event.tanggal_pelaksanaan, event.jam_mulai, event.jam_selesai FROM pembicara, pembicara_dan_event, event WHERE pembicara.id_pembicara = pembicara_dan_event.id_pembicara AND pembicara_dan_event.id_event = event.id_event AND pembicara.id_pembicara = ?', [$id]);
        return view('website-for-user.event.pembicara',[
            'title' => 'Pembicara - Pradita University\'s Guest Lecturers',
            'pembicara' => $pembicara,
        ]);
    }

    public function create($id)
    {
        $pembicara = DB::select('SELECT event.id_event, pembicara.nama, event.nama_event, event.tanggal_pelaksanaan, event.jam_mulai, event.jam_selesai FROM pembicara, pembicara_dan_event, event WHERE pembicara.id_pembicara = pembicara_dan_event.id_pembicara AND pembicara_dan_event.id_event = event.id_event AND event.id_event = ?', [$id]);
        // dd($pembicara);
        return view('website-for-user.event.presensi',[
            'title' => 'Input Presensi - Pradita University\'s Guest Lecturers',
            'pembicara' => $pembicara,
        ]);
    }

    public function store(Request $request, $id)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'nim' => 'required',
            'tanggal_pelaksanaan' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $tanggalDanJamMulai = $validatedData['tanggal_pelaksanaan']. " " .$validatedData['jam_mulai'];
        $tanggalDanJamSelesai = $validatedData['tanggal_pelaksanaan']. " " .$validatedData['jam_selesai'];
        $mulai = Carbon::parse($tanggalDanJamMulai)->format('Y-m-d H:i:s');
        $selesai = Carbon::parse($tanggalDanJamSelesai)->format('Y-m-d H:i:s');
        // dd($mulai);

        if($validatedData["nim"] != auth()->user()->mahasiswa->nim){
            return redirect()->back()->with('error', 'Anda tidak dapat mengisi presensi untuk orang lain');
        } # jika masukkan nim beda dengan user, kasih peringatan di halaman yang sama

        // dd(Carbon::now()->timezone('Asia/Jakarta'));

        if(Carbon::now()->timezone('Asia/Jakarta')< $mulai){
            return redirect()->back()->with('error', 'Anda tidak dapat mengisi presensi sebelum pelaksanaan event');
        } else if(Carbon::now()->timezone('Asia/Jakarta') > $selesai){
            return redirect()->back()->with('error', 'Event sudah selesai! Anda tidak dapat mengisi presensi setelah pelaksanaan event');
        }

        $presensi = [
            'id_event' => $id,
            'nim' => $validatedData['nim'],
            'waktu_presensi' => Carbon::now(),
        ];
        Presensi::create($presensi);
        return redirect()->route('eventuser.index')->with('success', 'Presensi has been added successfully');
    }

    public function nim($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        return response()->json($mahasiswa);
    }
}
