@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Form Proposal Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Proposal</h6>
                    <form action="{{ route("proposal.update",$proposal->id_proposal) }}" method='POST' enctype="multipart/form-data">
                        @method("PUT")
                        @csrf
                        <div class="row mb-3">
                            <label for="inputMataKuliahProposal" class="col-sm-2 col-form-label">Mata Kuliah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputMataKuliahProposal" name="mata_kuliah" value="{{ $proposal->mata_kuliah }}">
                                @error('mata_kuliah')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputLatarBelakangProposal" class="col-sm-2 col-form-label">Latar Belakang</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputLatarBelakangProposal" style="height: 150px; min-height: 50px;" name="latar_belakang">{{ $proposal->latar_belakang }}</textarea>
                                @error('latar_belakang')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputTujuanKegiatanProposal" class="col-sm-2 col-form-label">Tujuan Kegiatan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputTujuanKegiatanProposal" style="height: 150px; min-height: 50px;" name="tujuan_kegiatan">{{ $proposal->tujuan_kegiatan }}</textarea>
                                @error('tujuan_kegiatan')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputFileProposal" class="col-sm-2 col-form-label">File Proposal</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="inputFileProposal" name="oldfile_proposal" value="{{ $proposal->file_proposal != NULL ? $proposal->file_proposal : ''  }}">
                                <input class="form-control" type="file" id="inputFileProposal" name="file_proposal">
                                @if ($proposal->file_proposal != null)
                                    {{ 'Proposal yang telah diupload sebelumnya :' . $proposal->file_proposal }}
                                @endif
                                @error('file_proposal')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn btn-outline-warning m-2 float-end">Update Proposal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Proposal End -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection
