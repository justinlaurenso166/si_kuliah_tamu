<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $file = $request->query('file');
        $path = public_path($file);
        return Response()->download($path);
    }


    // public function photoDokumentasi(Request $request,$id)
    // {
    //     $file = 'foto/' . $id;
    //     return Storage::download($file);
    // }

    // public function pdfDokumentasi(Request $request,$id)
    // {
    //     $file = 'dokumentasi/' . $id;
    //     return Storage::download($file);
    // }

    // public function photoBackground(Request $request,$id)
    // {
    //     $file = 'background/' . $id;
    //     return Storage::download($file);
    // }

    // public function photoFlyer(Request $request,$id)
    // {
    //     $file = 'flyer/' . $id;
    //     return Storage::download($file);
    // }

    // public function pdfLaporanAkhir(Request $request,$id)
    // {
    //     $file = 'laporan_akhir/' . $id;
    //     return Storage::download($file);
    // }

    // public function photoPembicara(Request $request,$id)
    // {
    //     $file = 'pembicara/' . $id;
    //     return Storage::download($file);
    // }

    // public function pdfCV(Request $request,$id)
    // {
    //     $file = 'cv/' . $id;
    //     return Storage::download($file);
    // }

    // public function photoSertifikat(Request $request,$id)
    // {
    //     $file = 'sertifikat/' . $id;
    //     return Storage::download($file);
    // }

    // public function pdfProposal(Request $request,$id)
    // {
    //     $file = 'proposal/' . $id;
    //     return Storage::download($file);
    // }
}
