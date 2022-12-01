@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Form Pembicara Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Input Pembicara</h6>
                    <form action="{{ route("pembicara.update", $pembicara->id_pembicara) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <label for="inputNamaPembicara" class="col-sm-2 col-form-label">Nama Pembicara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNamaPembicara" name="nama" value="{{ $pembicara->nama }}">
                                @error('nama')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputInstitusiPembicara" class="col-sm-2 col-form-label">Institusi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputInstitusiPembicara" name="institusi" value="{{ $pembicara->institusi }}">
                                @error('institusi')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputJabatanPembicara" class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputJabatanPembicara" name="jabatan" value="{{ $pembicara->jabatan }}">
                                @error('jabatan')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputFotoPembicara" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="hidden" name='oldfoto' value='{{ $pembicara->foto != NULL ? $pembicara->foto : '' }}'>
                                <input class="form-control" type="file" id="inputFotoPembicara" name="foto">
                                @error('foto')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                                @if ($pembicara->foto)
                                    {{ 'Foto yang telah diupload sebelumnya : ' . $pembicara->foto }}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputCVPembicara" class="col-sm-2 col-form-label">CV</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="hidden" name='oldcv' value='{{ $pembicara->cv != NULL ? $pembicara->cv : '' }}'>
                                <input class="form-control" type="file" id="inputCVPembicara" name="cv">
                                @error('cv')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                                @if ($pembicara->cv)
                                    {{ 'CV yang telah diupload sebelumnya : ' . $pembicara->cv }}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNPWPPembicara" class="col-sm-2 col-form-label">NPWP</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputNPWPPembicara" name="npwp" value="{{ $pembicara->npwp }}">
                                @error('npwp')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputBankPembicara" class="col-sm-2 col-form-label">Bank</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputBankPembicara" name="bank" value="{{ $pembicara->bank }}">
                                @error('bank')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNoRekeningPembicara" class="col-sm-2 col-form-label">No. Rekening</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputNoRekeningPembicara" name="no_rekening" value="{{ $pembicara->no_rekening }}">
                                @error('no_rekening')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-warning m-2 float-end">Update Pembicara</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Pembicara Ends -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection
