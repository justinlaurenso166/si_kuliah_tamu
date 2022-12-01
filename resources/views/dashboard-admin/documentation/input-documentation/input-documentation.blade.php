@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Form Dokumentasi Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Input Dokumentasi Event</h6>
                    <form action="{{ route('documentation.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputDokumentasiDariEvent" class="col-sm-2 col-form-label">Event</label>
                            <div class="col-sm-10">
                                <select class="form-select form-control" id="inputDokumentasiDariEvent" name='id_event'>
                                    <option selected value=''>Pilih...</option>
                                    @forelse ($event as $e)
                                        <option value="{{ $e->id_event }}">
                                            <span class="idEvent">{{ $e->id_event }}</span> - <span class="namaEvent">{{ $e->nama_event }}</span>
                                        </option>
                                    @empty

                                    @endforelse
                                </select>
                                @error('id_event')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputFotoDokumentasi1" class="col-sm-2 col-form-label">Foto 1</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="inputFotoDokumentasi1" name='foto_1'>
                                @error('foto_1')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputFotoDokumentasi2" class="col-sm-2 col-form-label">Foto 2</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="inputFotoDokumentasi2" name='foto_2'>
                                @error('foto_2')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputLinkVideoDokumentasi" class="col-sm-2 col-form-label">Link Video</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLinkVideoDokumentasi" name="video">
                                @error('video')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputFeedbackDokumentasi" class="col-sm-2 col-form-label">Feedback</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="inputFeedbackDokumentasi" name="feedback">
                                @error('feedback')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-warning m-2 float-end">Submit Dokumentasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Dokumentasi Ends -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection
