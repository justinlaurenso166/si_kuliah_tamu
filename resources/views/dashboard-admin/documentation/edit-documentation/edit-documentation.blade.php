@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Form Dokumentasi Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Dokumentasi Event</h6>
                    <form action="{{ route('documentation.update', $documentation[0]->id_dokumentasi) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <label for="inputDokumentasiDariEvent" class="col-sm-2 col-form-label">Event</label>
                            <div class="col-sm-10">
                                <select class="form-select form-control" id="inputDokumentasiDariEvent" name='id_event'>
                                    @forelse ($event as $e)
                                        <option value="{{ $e->id_event }}" {{ $e->id_event == $documentation[0]->id_event ? 'selected' : '' }}>
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
                                <input class="form-control" type="hidden" name='oldfoto_1' value='{{ $documentation[0]->foto != NULL ? $documentation[0]->foto : '' }}'>
                                <input class="form-control" type="hidden" name='id_foto_1' value='{{ $documentation[0]->id_foto != NULL ? $documentation[0]->id_foto : '' }}'>
                                <input class="form-control" type="file" id="inputFotoDokumentasi1" name='foto_1'>
                                @error('foto_1')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                                @if ($documentation[0]->foto)
                                    {{ 'Foto yang diupload sebelumnya : ' . $documentation[0]->foto }}
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputFotoDokumentasi2" class="col-sm-2 col-form-label">Foto 2</label>
                            <div class="col-sm-10">
                                @if (count($documentation) > 1)
                                <input class="form-control" type="hidden" name='oldfoto_2' value='{{ $documentation[1]->foto != NULL ? $documentation[1]->foto : '' }}'>
                                <input class="form-control" type="hidden" name='id_foto_2' value='{{ $documentation[1]->id_foto != NULL ? $documentation[1]->id_foto : '' }}'>
                                @endif

                                <input class="form-control" type="file" id="inputFotoDokumentasi2" name='foto_2'>
                                @error('foto_2')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                                @if (count($documentation) > 1)
                                @if ($documentation[1]->foto)
                                    {{ 'Foto yang diupload sebelumnya :  ' . $documentation[1]->foto }}
                                @endif
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputLinkVideoDokumentasi" class="col-sm-2 col-form-label">Link Video</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLinkVideoDokumentasi" name="video" value="{{ $documentation[0]->video }}">
                                @error('video')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputFeedbackDokumentasi" class="col-sm-2 col-form-label">Feedback</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="hidden" name='oldfeedback' value='{{ $documentation[0]->feedback != NULL ? $documentation[0]->feedback : '' }}'>
                                <input class="form-control" type="file" id="inputFeedbackDokumentasi" name="feedback" value="{{ $documentation[0]->feedback }}">
                                @error('feedback')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                                @if ($documentation[0]->feedback)
                                    {{ 'Dokumen feedback yang diupload sebelumnya : ' . $documentation[0]->feedback }}
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-warning m-2 float-end">Update Dokumentasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Dokumentasi Ends -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection
