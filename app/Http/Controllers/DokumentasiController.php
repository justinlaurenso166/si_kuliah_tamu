<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Event;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->query('id_dokumentasi');
        if($id){
            $singleDocumentation = DB::select('SELECT * from dokumentasi, event, foto WHERE dokumentasi.id_event = event.id_event AND dokumentasi.id_dokumentasi = foto.id_dokumentasi AND dokumentasi.id_dokumentasi = ?', [$id]);
            $documentation = DB::select('SELECT * FROM dokumentasi, event WHERE dokumentasi.id_event = event.id_event');
            return view('dashboard-admin.documentation.detail-documentation.download-documentation',[
            'title' => 'Data Dokumentasi - Pradita University\'s Guest Lecturers',
            'documentation' => $documentation,
            'singleDocumentation' => $singleDocumentation
        ]);
        }else{
            $documentation = DB::select('SELECT * FROM dokumentasi, event WHERE dokumentasi.id_event = event.id_event');
            return view('dashboard-admin.documentation.detail-documentation.download-documentation',[
            'title' => 'Data Dokumentasi - Pradita University\'s Guest Lecturers',
            'documentation' => $documentation,
            'singleDocumentation' => null
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
        $event = Event::all();
        return view('dashboard-admin.documentation.input-documentation.input-documentation',[
            'title' => 'Input Dokumentasi - Pradita University\'s Guest Lecturers',
            'event' => $event
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
            'id_event' => 'required',
            'video' => 'nullable',
            'foto_1' => 'required|file|mimes:jpeg,png,jpg|max:3072',
            'foto_2' => 'nullable|file|mimes:jpeg,png,jpg|max:3072',
            'feedback' => 'nullable|mimes:pdf,docx,doc|max:2048',
        ]);

        $documentation = [
            'id_event' => $validatedData['id_event'],
            'video' => $validatedData['video'],
        ];

        if($request->feedback){
            $feedback = $request->file('feedback');
            $feedback_name = $feedback->getClientOriginalName();
            $feedback->move(public_path('/penyimpanan/feedback'), $feedback_name);
            $feedback_path = "/penyimpanan/feedback/" . $feedback_name;
            $validatedData['feedback'] = $feedback_path;
            $documentation['feedback'] = $validatedData['feedback'];
        };


        $idDokumentasi = Dokumentasi::create($documentation)->id;
        if($request->foto_1){
            $foto_1 = $request->file('foto_1');
            $foto_1_name = $foto_1->getClientOriginalName();
            $foto_1->move(public_path('/penyimpanan/dokumentasi'), $foto_1_name);
            $foto_1_path = "/penyimpanan/dokumentasi/" . $foto_1_name;

            $foto1 = [
                'id_dokumentasi' => $idDokumentasi,
                'foto' => $foto_1_path
            ];
            Foto::create($foto1);
        };


        if($request->foto_2){
            $foto_2 = $request->file('foto_2');
            $foto_2_name = $foto_2->getClientOriginalName();
            $foto_2->move(public_path('/penyimpanan/dokumentasi'), $foto_2_name);
            $foto_2_path = "/penyimpanan/dokumentasi/" . $foto_2_name;

            $foto2 = [
                'id_dokumentasi' => $idDokumentasi,
                'foto' => $foto_2_path
            ];
            Foto::create($foto2);
        };

        return redirect()->intended(route('documentation.index'))->with('success', 'Documentation has been successfully added');
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
        $documentation = DB::select('SELECT * FROM dokumentasi, foto WHERE dokumentasi.id_dokumentasi = foto.id_dokumentasi AND dokumentasi.id_dokumentasi = ?', [$id]);
        $event = Event::all();
        // dd($documentation);
        return view('dashboard-admin.documentation.edit-documentation.edit-documentation',[
            'title' => 'Edit Dokumentasi - Pradita University\'s Guest Lecturers',
            'documentation' => $documentation,
            'event' => $event
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
            'id_event' => 'required',
            'video' => 'nullable',
            'foto_1' => 'nullable|file|mimes:jpeg,png,jpg|max:3072',
            'foto_2' => 'nullable|file|mimes:jpeg,png,jpg|max:3072',
            'feedback' => 'nullable|mimes:pdf,docx,doc|max:2048',
            'oldfoto_1' => 'required',
            'oldfoto_2' => 'nullable',
            'oldfeedback' => 'nullable'
        ]);

        $documentation = [
            'id_event' => $validatedData['id_event'],
            'video' => $validatedData['video'],
        ];

        if($request->file('feedback')){
            $feedback = $request->file('feedback');
            $feedback_name = $feedback->getClientOriginalName();
            $feedback->move(public_path('/penyimpanan/feedback'), $feedback_name);
            $feedback_path = "/penyimpanan/feedback/" . $feedback_name;
            $validatedData['feedback'] = $feedback_path;
            $documentation['feedback'] = $validatedData['feedback'];
            if($request->oldfeedback){
                $oldfeedback = $request->oldfeedback;
                unlink(public_path($oldfeedback));
            }
        }

        // $idDokumentasi = Dokumentasi::where('id_dokumentasi', $id)->update($documentation)->id;

        if($request->foto_1){
            $foto_1 = $request->file('foto_1');
            $foto_1_name = $foto_1->getClientOriginalName();
            $foto_1->move(public_path('/penyimpanan/dokumentasi'), $foto_1_name);
            $foto_1_path = "/penyimpanan/dokumentasi/" . $foto_1_name;
            $foto1 = [
                'id_dokumentasi' => $id,
                'foto' => $foto_1_path
            ];
            Foto::where('id_dokumentasi', $id)->where('id_foto', $request->id_foto_1)->update($foto1);

            if($request->oldfoto_1){
                $oldfoto_1 = $request->oldfoto_1;
                unlink(public_path($oldfoto_1));
            }
        }


        if($request->foto_2){
            $foto_2 = $request->file('foto_2');
            // dd($foto_2);
            $foto_2_name = $foto_2->getClientOriginalName();
            $foto_2->move(public_path('/penyimpanan/dokumentasi'), $foto_2_name);
            $foto_2_path = "/penyimpanan/dokumentasi/" . $foto_2_name;
            $foto2 = [
                'id_dokumentasi' => $id,
                'foto' => $foto_2_path
            ];
            // dd($foto2);
            Foto::where('id_dokumentasi', $id)->where('id_foto', $request->id_foto_2 )->update($foto2);
            if($request->oldfoto_2){
                $oldfoto_2 = $request->oldfoto_2;
                unlink(public_path($oldfoto_2));
            }
        } else if($request->foto_2){
            $foto_2 = $request->file('foto_2');
            $foto_2_name = $foto_2->getClientOriginalName();
            $foto_2->move(public_path('/penyimpanan/dokumentasi'), $foto_2_name);
            $foto_2_path = "/penyimpanan/dokumentasi/" . $foto_2_name;

            $foto2 = [
                'id_dokumentasi' => $id,
                'foto' => $foto_2_path
            ];
            Foto::create($foto2);
        };

        Dokumentasi::where('id_dokumentasi', $id)->update($documentation);
        return redirect()->intended(route('documentation.index'))->with('success', 'Documentation has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentation = Dokumentasi::where('id_dokumentasi', $id);
        // dd($documentation->first()->feedback);
        $foto = Foto::where('id_dokumentasi', $id)->get();

        if($documentation->first()->feedback != null){
            unlink(public_path($documentation->first()->feedback));
        }

        foreach($foto as $f){
            unlink(public_path($f->foto));
        }

        $documentation->delete();
        return redirect()->intended(route('documentation.index'))->with('success', 'Documentation has been successfully deleted');
    }
}
