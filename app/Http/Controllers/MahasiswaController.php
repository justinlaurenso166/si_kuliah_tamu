<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('dashboard-admin.mahasiswa.detail-mahasiswa.detail-mahasiswa',[
            'title' => 'Data Mahasiswa - Pradita University\'s Guest Lecturers',
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard-admin.mahasiswa.input-mahasiswa.input-mahasiswa',[
            'title' => 'Input Mahasiswa - Pradita University\'s Guest Lecturers',
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
            'nim' => 'required|numeric|unique:mahasiswa',
            'nama_mahasiswa' => 'required|string',
            'jenis_kelamin' => 'required|string|min:1|max:1',
            'prodi' => 'required|string',
            'angkatan' => 'required|numeric',
            'email' => 'required|unique:users|email:dns',
            'username' => 'required|alpha_dash|unique:users',
            'password' => 'required|min:6'

        ]);

        $userAwal = [
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']),
            'id_role' => '2'
        ];

        $idUser = User::create($userAwal)->id;

        $mahasiswaAwal = [
            'nim' => $validatedData['nim'],
            'nama_mahasiswa' => strtoupper($validatedData['nama_mahasiswa']),
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'prodi' => $validatedData['prodi'],
            'angkatan' => $validatedData['angkatan'],
            'id_users' => $idUser
        ];

        Mahasiswa::create($mahasiswaAwal);

        return redirect()->intended(route('mahasiswa.index'))->with('success','Mahasiswa has been successfully added');
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
        $mahasiswa = Mahasiswa::where("nim", $id)->get()->first();
        $users = User::where("id", $mahasiswa->id_users)->get()->first();
        // dd($mahasiswa);
        return view('dashboard-admin.mahasiswa.edit-mahasiswa.edit-mahasiswa',[
            'title' => 'Edit Mahasiswa - Pradita University\'s Guest Lecturers',
            'mahasiswa' => $mahasiswa,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        $validatedData = $request->validate([
            'nama_mahasiswa' => 'required|string',
            'jenis_kelamin' => 'required|string|min:1|max:1',
            'prodi' => 'required|string',
            'angkatan' => 'required|numeric',
        ]);

        $mahasiswaAwal = [
            'nama_mahasiswa' => strtoupper($validatedData['nama_mahasiswa']),
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'prodi' => $validatedData['prodi'],
            'angkatan' => $validatedData['angkatan']
        ];

        Mahasiswa::where('nim',$nim)->update($mahasiswaAwal);

        return redirect()->intended(route('mahasiswa.index'))->with('success','Mahasiswa has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->get()->first();
        User::where('id', $mahasiswa->id_users)->delete();
        Mahasiswa::where('nim', $nim)->delete();
        return redirect()->intended(route('mahasiswa.index'))->with('success','Mahasiswa has been successfully deleted');
    }
}
