<?php

namespace App\Http\Controllers;

use App\Models\PIC;
use App\Models\Event;
use App\Models\Proposal;
use App\Models\Pembicara;
use Illuminate\Http\Request;
use App\Models\PembicaraDanEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
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
            // DB::enableQueryLog();
            $singleEvent = Event::select("id_event","nama_event", "cara_pelaksanaan", "tempat_pelaksanaan","link","jam_mulai", "jam_selesai", "laporan_akhir", "background", "flyer", "file_proposal")->leftJoin('pic', 'event.id_pic', '=', 'pic.id_pic')->leftJoin('proposal', 'event.id_proposal', '=', 'proposal.id_proposal')->where('id_event', $id)->with('pembicara')->get()->first();
            // $quries = DB::getQueryLog();
            // dd($quries);

            // dd($singleEvent); //pake Event karena ada relasi di model Event
            $event = Event::select('*')->leftJoin('pic', 'event.id_pic', '=', 'pic.id_pic')->leftJoin('proposal', 'event.id_proposal', '=', 'proposal.id_proposal')->with('pembicara')->get();
            $pembicaraDanEvent = PembicaraDanEvent::all();
            return view('dashboard-admin.event.detail-event.detail-event',[
                'title' => 'Data Event - Pradita University\'s Guest Lecturers',
                'event' => $event,
                'singleEvent' => $singleEvent,
                'pembicaraDanEvent' => $pembicaraDanEvent
            ]);
        }else{
            $event = Event::select('*')->leftJoin('pic', 'event.id_pic', '=', 'pic.id_pic')->leftJoin('proposal', 'event.id_proposal', '=', 'proposal.id_proposal')->with('pembicara')->get();
            return view('dashboard-admin.event.detail-event.detail-event',[
                'title' => 'Data Event - Pradita University\'s Guest Lecturers',
                'event' => $event,
                'singleEvent' => null
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
        $pic = PIC::all();
        $proposal = Proposal::select(['id_proposal', 'mata_kuliah', 'waktu_pengunggahan'])->get();
        return view('dashboard-admin.event.input-event.input-event',[
            'title' => 'Input Event - Pradita University\'s Guest Lecturers',
            'pic' => $pic,
            'proposal' => $proposal,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_event' => 'required',
            'cara_pelaksanaan' => 'required',
            'background' => 'required|mimes:jpg,png,jpeg|max:2048',
            'flyer' => 'required|mimes:jpg,png,jpeg|max:2048',
            'tempat_pelaksanaan' => 'required',
            'link' => 'nullable',
            'tanggal_pelaksanaan' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'id_pic' => 'required',
            'id_proposal' => 'required',
        ]);

        //Source : https://www.codegrepper.com/code-examples/php/laravel+8+upload+file+to+public+folder
        $background = $request->file('background');
        $background_name = $background->getClientOriginalName();
        $background->move(public_path('/penyimpanan/background'), $background_name);
        $background_path = "/penyimpanan/background/" . $background_name;
        $validatedData['background'] = $background_path;

        $flyer = $request->file('flyer');
        $flyer_name = $flyer->getClientOriginalName();
        $flyer->move(public_path('/penyimpanan/flyer'), $flyer_name);
        $flyer_path = "/penyimpanan/flyer/" . $flyer_name;
        $validatedData['flyer'] = $flyer_path;


        Event::create($validatedData);
        return redirect()->route('event.index')->with('success','Data Event has been added successfully');
    }

    public function storePembicara(Request $request)
    {
        $validatedData = $request->validate([
            'id_event' => 'required',
            'id_pembicara' => 'required'
        ]);
        for($i = 0; $i < count($validatedData['id_pembicara']); $i++){
            $batchPembicara[$i] = [
                'id_event' => $validatedData['id_event'],
                'id_pembicara' => $validatedData['id_pembicara'][$i]
            ];
        }
        PembicaraDanEvent::insert($batchPembicara);
        return redirect()->route('event.index')->with('success', 'Data Pembicara has been added successfully');
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
        $event = DB::select('SELECT * FROM event NATURAL LEFT JOIN pembicara_dan_event NATURAL LEFT JOIN pembicara NATURAL LEFT JOIN pic NATURAL LEFT JOIN proposal WHERE event.id_event = ?', [$id]);
        $pic = PIC::all();
        $proposal = Proposal::all();
        return view('dashboard-admin.event.edit-event.edit-event',[
            'title' => 'Edit Event - Pradita University\'s Guest Lecturers',
            'event' => $event,
            'pic' => $pic,
            'proposal' => $proposal,
        ]);

    }

    public function editPembicara($id){
        $singleEvent = DB::select('SELECT * FROM event NATURAL LEFT JOIN pembicara_dan_event WHERE event.id_event = ?', [$id]);
        $pembicara = Pembicara::all();
        // dd($singleEvent);
        return view('dashboard-admin.event.edit-pembicara-ke-event.edit-pembicara-ke-event',[
            'title' => 'Edit Pembicara - Pradita University\'s Guest Lecturers',
            'singleEvent' => $singleEvent,
            'pembicara' => $pembicara
        ]);
    }

    public function editLaporanAkhir($id){
        $event = Event::where('id_event', $id)->get()->first();
        return view('dashboard-admin.event.edit-laporan-akhir.edit-laporan-akhir',[
            'title' => 'Edit Laporan Akhir - Pradita University\'s Guest Lecturers',
            'event' => $event
        ]);
    }

    public function editSertifikat($id, $id1){
        $pembicaraDanEvent = DB::select('SELECT * FROM event NATURAL LEFT JOIN pembicara_dan_event, pembicara WHERE pembicara_dan_event.id_pembicara = pembicara.id_pembicara AND event.id_event = ? AND pembicara.id_pembicara = ?', [$id, $id1]);
        // $pembicaraDanEvent = PembicaraDanEvent::where('id_event', $id)->where('id_pembicara', $id1)->get()->first();
        // dd($pembicaraDanEvent);
        return view('dashboard-admin.event.edit-sertifikat.edit-sertifikat',[
            'title' => 'Edit Sertifikat - Pradita University\'s Guest Lecturers',
            'pembicaraDanEvent' => $pembicaraDanEvent
        ]);
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
        $validatedData = $request->validate([
            'nama_event' => 'required',
            'cara_pelaksanaan' => 'required',
            'background' => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'flyer' => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'tempat_pelaksanaan' => 'required',
            'link' => 'nullable',
            'tanggal_pelaksanaan' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'id_pic' => 'required',
            'id_proposal' => 'required',
            'oldbackground' => 'required',
            'oldflyer' => 'required'
        ]);

        $event = [
            'nama_event' => $validatedData['nama_event'],
            'cara_pelaksanaan' => $validatedData['cara_pelaksanaan'],
            'tempat_pelaksanaan' => $validatedData['tempat_pelaksanaan'],
            'link' => $validatedData['link'],
            'tanggal_pelaksanaan' => $validatedData['tanggal_pelaksanaan'],
            'jam_mulai' => $validatedData['jam_mulai'],
            'jam_selesai' => $validatedData['jam_selesai'],
            'id_pic' => $validatedData['id_pic'],
            'id_proposal' => $validatedData['id_proposal'],
        ];

        if($request->file('background')){
            $background = $request->file('background');
            $background_name = $background->getClientOriginalName();
            $background->move(public_path('/penyimpanan/background'), $background_name);
            $background_path = "/penyimpanan/background/" . $background_name;
            $validatedData['background'] = $background_path;
            $event['background'] = $validatedData['background'];
            if($request->oldbackground){
                $oldbackground = $request->oldbackground;
                unlink(public_path($oldbackground));
            }
        }

        if($request->file('flyer')){
            $flyer = $request->file('flyer');
            $flyer_name = $flyer->getClientOriginalName();
            $flyer->move(public_path('/penyimpanan/flyer'), $flyer_name);
            $flyer_path = "/penyimpanan/flyer/" . $flyer_name;
            $validatedData['flyer'] = $flyer_path;
            $event['flyer'] = $validatedData['flyer'];
            if($request->oldflyer){
                $oldflyer = $request->oldflyer;
                unlink(public_path($oldflyer));
            }
        }

        Event::where('id_event', $id)->update($event);
        return redirect()->route('event.index')->with('success', 'Data Event has been updated successfully');

    }

    public function updateLaporanAkhir(Request $request, $id){
        // dd($request->all());
        $validatedData = $request->validate([
            'laporan_akhir' => 'required|mimes:pdf,docx,doc|max:2048',
            'oldlaporan_akhir' => 'nullable'
        ]);

        if($request->file('laporan_akhir')){
            $laporan_akhir = $request->file('laporan_akhir');
            $laporan_akhir_name = $laporan_akhir->getClientOriginalName();
            $laporan_akhir->move(public_path('/penyimpanan/laporan_akhir'), $laporan_akhir_name);
            $laporan_akhir_path = "/penyimpanan/laporan_akhir/" . $laporan_akhir_name;
            $validatedData['laporan_akhir'] = $laporan_akhir_path;
            $laporan_akhir_update = [
                'laporan_akhir' => $validatedData['laporan_akhir']
            ];
            if($request->oldlaporan_akhir){
                $oldlaporan_akhir = $request->oldlaporan_akhir;
                unlink(public_path($oldlaporan_akhir));
            }
        }

        // dd($laporan_akhir_update);

        Event::where('id_event',$id)->update($laporan_akhir_update);
        return redirect()->route('event.index')->with('success', 'Data Laporan Akhir has been updated successfully');
    }

    public function updateSertifikat(Request $request, $id_event, $id_pembicara){
        // dd($request->all());
        $validatedData = $request->validate([
            'sertifikat' => 'required|mimes:pdf,png,jpg,jpeg|max:2048',
            'oldsertifikat' => 'nullable'
        ]);

        if($request->file('sertifikat')){
            $sertifikat = $request->file('sertifikat');
            $sertifikat_name = $sertifikat->getClientOriginalName();
            $sertifikat->move(public_path('/penyimpanan/sertifikat'), $sertifikat_name);
            $sertifikat_path = "/penyimpanan/sertifikat/" . $sertifikat_name;
            $validatedData['sertifikat'] = $sertifikat_path;
            $sertifikat_update = [
                'sertifikat' => $validatedData['sertifikat']
            ];
            if($request->oldsertifikat){
                $oldsertifikat = $request->oldsertifikat;
                unlink(public_path($oldsertifikat));
            }
        }

        PembicaraDanEvent::where('id_event',$id_event)->where('id_pembicara', $id_pembicara)->update($sertifikat_update);
        return redirect()->route('event.index')->with('success', 'Data Sertifikat has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::where('id_event', $id)->get()->first();
        unlink(public_path($event->background));
        unlink(public_path($event->flyer));

        if($event->laporan_akhir != null){
            unlink(public_path($event->laporan_akhir));
        }
        Event::where('id_event', $id)->delete();
        return redirect()->route('event.index')->with('success', 'Data Event has been deleted successfully');
    }

    public function destroyPembicara($id_event, $id_pembicara)
    {
        $pembicaraDanEvent = PembicaraDanEvent::where('id_event', $id_event)->where('id_pembicara', $id_pembicara)->get()->first();
        if($pembicaraDanEvent->sertifikat != null){
            unlink(public_path($pembicaraDanEvent->sertifikat));
        }
        PembicaraDanEvent::where('id_event', $id_event)->where('id_pembicara', $id_pembicara)->delete();
        return redirect()->route('event.index')->with('success', 'Data Pembicara has been deleted successfully');
    }
}
