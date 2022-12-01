<?php

namespace App\Http\Controllers;

use App\Models\PIC;
use Illuminate\Http\Request;

class PICController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pic = PIC::all();
        return view('dashboard-admin.pic.detail-pic.detail-pic',[
            'title' => 'Data PIC - Pradita University\'s Guest Lecturers',
            'pic' => $pic
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard-admin.pic.input-pic.input-pic',[
            'title' => 'Input PIC - Pradita University\'s Guest Lecturers',
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
            'nama_dosen' => 'required|string',
            'prodi' => 'required|string'
        ]);

        $picAwal = [
            'nama_dosen' => $validatedData['nama_dosen'],
            'prodi' => $validatedData['prodi']
        ];

        PIC::create($picAwal);

        return redirect()->intended(route('pic.index'))->with('success','PIC has been successfully added');
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
        $pic = PIC::where('id_pic',$id)->get()->first();
        return view('dashboard-admin.pic.edit-pic.edit-pic',[
            'title' => 'Edit PIC - Pradita University\'s Guest Lecturers',
            'pic' => $pic
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
            'nama_dosen' => 'required|string',
            'prodi' => 'required|string'
        ]);

        $picAwal = [
            'nama_dosen' => $validatedData['nama_dosen'],
            'prodi' => $validatedData['prodi']
        ];

        PIC::where('id_pic',$id)->update($picAwal);

        return redirect()->intended(route('pic.index'))->with('success','PIC has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pic = PIC::where('id_pic', $id);
        $pic->delete();
        return redirect()->intended(route('pic.index'))->with('success','PIC has been successfully deleted');
    }
}
