@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Form Event Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">

                    <div class="d-flex justify-content-between">
                        <h6 class="mb-4">
                            @if ($pembicaraDanEvent[0]->sertifikat != NULL)
                                Edit Sertifikat Pembicara
                            @else
                                Input Sertifikat Pembicara
                            @endif
                            - <span class="nama-event">{{ $pembicaraDanEvent[0]->nama_event }}</span>
                            - <span class="nama-pembicara">{{ $pembicaraDanEvent[0]->nama }}</span>
                        </h6>
                        <div class="button-show">
                            <a class="btn btn-sm btn-outline-info" href="{{ $pembicaraDanEvent[0]->sertifikat }}">Tampilkan Sertifikat</a>
                        </div>
                    </div>


                    <form action="{{ route('event.updateSertifikat', [$pembicaraDanEvent[0]->id_event, $pembicaraDanEvent[0]->id_pembicara]) }}" method='POST' enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <label for="inputLaporanAkhirEvent" class="col-sm-2 col-form-label">Sertifikat</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="hidden" name='oldsertifikat' value='{{ $pembicaraDanEvent[0]->sertifikat != NULL ? $pembicaraDanEvent[0]->sertifikat : '' }}'>
                                <input class="form-control" type="file" id="inputLaporanAkhirEvent" name="sertifikat">
                                @if ($pembicaraDanEvent[0]->sertifikat)
                                    {{ 'Dokumen sertifikat yang diupload sebelumnya : ' . $pembicaraDanEvent[0]->sertifikat }}
                                @endif
                                @error('sertifikat')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-warning m-2 float-end">
                            @if ($pembicaraDanEvent[0]->sertifikat != NULL)
                            Update Sertifikat Pembicara
                            @else
                            Input Sertifikat Pembicara
                            @endif
                            </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Form Event Ends -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection
