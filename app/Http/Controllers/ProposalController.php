<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->query('id_proposal');
        if($id){
            $singleProposal = DB::select('SELECT * from proposal WHERE proposal.id_proposal = ?', [$id]);
            $proposal = Proposal::all();
            return view('dashboard-admin.proposal.detail-proposal.proposal-data',[
            'title' => 'Data Proposal - Pradita University\'s Guest Lecturers',
            'proposal' => $proposal,
            'singleProposal' => $singleProposal
        ]);
        }else{
            $proposal = Proposal::all();
            return view('dashboard-admin.proposal.detail-proposal.proposal-data',[
            'title' => 'Data Proposal - Pradita University\'s Guest Lecturers',
            'proposal' => $proposal,
            'singleProposal' => null
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
        return view('dashboard-admin.proposal.input-proposal.input-proposal',[
            'title' => 'Input Proposal - Pradita University\'s Guest Lecturers',
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
            'mata_kuliah' => 'required|string',
            'latar_belakang' => 'required|string',
            'tujuan_kegiatan' => 'required|string',
            'file_proposal' => 'required|mimes:pdf,docx,doc|max:2048'
        ]);

        $file_proposal = $request->file('file_proposal');
        $file_proposal_name = $file_proposal->getClientOriginalName();
        // dd($file_proposal->move(public_path('/penyimpanan/proposal'), $file_proposal_name)->openFile());
        $file_proposal->move(public_path('/penyimpanan/proposal'), $file_proposal_name);
        $proposal_path = "/penyimpanan/proposal/" . $file_proposal_name;
        $validatedData['file_proposal'] = $proposal_path;

        $proposalAwal = [
            'mata_kuliah' => $validatedData['mata_kuliah'],
            'latar_belakang' => $validatedData['latar_belakang'],
            'tujuan_kegiatan' => $validatedData['tujuan_kegiatan'],
            'file_proposal' => $validatedData['file_proposal'],
            'waktu_pengunggahan' => Carbon::now(),
        ];

        Proposal::create($proposalAwal);

        return redirect()->intended(route('proposal.index'))->with('success','Proposal has been successfully added');
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
        $proposal = Proposal::where('id_proposal',$id)->first();
        // dd($proposal);
        return view('dashboard-admin.proposal.edit-proposal.edit-proposal',[
            'title' => 'Edit Proposal - Pradita University\'s Guest Lecturers',
            'proposal' => $proposal
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
            'mata_kuliah' => 'required|string',
            'latar_belakang' => 'required|string',
            'tujuan_kegiatan' => 'required|string',
            'file_proposal' => 'nullable|mimes:pdf,docx,doc|max:2048',
            'oldfile_proposal' => 'required'
        ]);

        $proposalAwal = [
            'mata_kuliah' => $validatedData['mata_kuliah'],
            'latar_belakang' => $validatedData['latar_belakang'],
            'tujuan_kegiatan' => $validatedData['tujuan_kegiatan'],
        ];

        if($request->file('file_proposal')){
            $file_proposal = $request->file('file_proposal');
            $file_proposal_name = $file_proposal->getClientOriginalName();
            $file_proposal->move(public_path('/penyimpanan/proposal'), $file_proposal_name);

            $file_proposal_path = "/penyimpanan/proposal/" . $file_proposal_name;
            $validatedData['file_proposal'] = $file_proposal_path;
            $proposalAwal['file_proposal'] = $validatedData['file_proposal'];
            if($request->oldfile_proposal){
                $oldfile_proposal = $request->oldfile_proposal;
                unlink(public_path($oldfile_proposal));
            }
        }

        Proposal::where('id_proposal',$id)->update($proposalAwal);
        return redirect()->intended(route('proposal.index'))->with('success','Proposal has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idProposal)
    {
        $proposal = Proposal::where('id_proposal', $idProposal)->get()->first();
        unlink(public_path($proposal->file_proposal));
        // dd($proposal);
        // Storage::delete($proposal->file_proposal);
        Proposal::where('id_proposal', $idProposal)->delete();
        return redirect()->intended(route('proposal.index'))->with('success','Proposal has been successfully deleted');
    }
}
