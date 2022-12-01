@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Form Event Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">

                    {{-- Jika laporan akhir sudah ada --}}
                    <h6 class="mb-4">
                        @if ($event->laporan_akhir != NULL)
                            Edit Laporan Akhir Event
                        @else
                            Input Laporan Akhir Event
                        @endif
                        - <span class="nama-event">{{ $event->nama_event }}</span></h6>
                    <form action="{{ route('event.updateLaporanAkhir', $event->id_event) }}" method='POST' enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <label for="inputLaporanAkhirEvent" class="col-sm-2 col-form-label">Laporan Akhir</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="hidden" name='oldlaporan_akhir' value='{{ $event->laporan_akhir != NULL ? $event->laporan_akhir : '' }}'>
                                <input class="form-control" type="file" id="inputLaporanAkhirEvent" name="laporan_akhir">
                                @if ($event->laporan_akhir)
                                    {{ 'Dokumen laporan akhir yang diupload sebelumnya : ' . $event->laporan_akhir }}
                                @endif
                                @error('laporan_akhir')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-warning m-2 float-end">
                            @if ($event->laporan_akhir != NULL)
                            Update Laporan Akhir
                            @else
                            Input Laporan Akhir
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
