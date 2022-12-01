@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Form Event Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Input Event</h6>
                    <form action="{{ route('event.update', $event[0]->id_event) }}" method='POST' enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3">
                            <label for="inputNamaEvent" class="col-sm-2 col-form-label">Nama Event</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNamaEvent" name="nama_event" value="{{ $event[0]->nama_event}}">
                                @error('nama_event')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputCaraPelaksanaanEvent" class="col-sm-2 col-form-label">Cara Pelaksanaan</label>
                            <div class="col-sm-10">
                                <select class="form-select form-control" id="inputCaraPelaksanaanEvent" name="cara_pelaksanaan">
                                    <option selected>Pilih...</option>
                                    <option value="Offline" {{ $event[0]->cara_pelaksanaan == "Offline" ? "selected" : ""}}>Offline</option>
                                    <option value="Online" {{ $event[0]->cara_pelaksanaan == "Online" ? "selected" : ""}}>Online</option>
                                    <option value="Hybrid" {{ $event[0]->cara_pelaksanaan == "Hybrid" ? "selected" : ""}}>Hybrid</option>
                                </select>
                                @error('cara_pelaksanaan')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputBackgroundEvent" class="col-sm-2 col-form-label">Background</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="hidden" name='oldbackground' value='{{ $event[0]->background != NULL ? $event[0]->background : '' }}'>
                                <input class="form-control" type="file" id="inputBackgroundEvent" name="background">
                                @error('background')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                                @if ($event[0]->background)
                                    {{ 'Foto background yang diupload sebelumnya : ' . $event[0]->background }}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputFlyerEvent" class="col-sm-2 col-form-label">Flyer</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="hidden" name='oldflyer' value='{{ $event[0]->flyer != NULL ? $event[0]->flyer : '' }}'>
                                <input class="form-control" type="file" id="inputFlyerEvent" name="flyer">
                                @error('flyer')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                                @if ($event[0]->flyer)
                                    {{ 'Foto flyer yang diupload sebelumnya :  ' . $event[0]->flyer }}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputTempatPelaksanaanEvent" class="col-sm-2 col-form-label">Tempat Pelaksanaan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputTempatPelaksanaanEvent" name="tempat_pelaksanaan" value='{{ $event[0]->tempat_pelaksanaan }}'>
                                @error('tempat_pelaksanaan')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputLinkEvent" class="col-sm-2 col-form-label">Link</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLinkEvent" name="link" value="{{ $event[0]->link }}">
                                @error('link')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputTanggalPelaksanaanEvent" class="col-sm-2 col-form-label">Tanggal Pelaksanaan</label>
                            <div class="col-sm-10">
                                <input type="date" placeholder="yyyy-mm-dd" class="form-control" min="1997-01-01" max="2080-12-31" id="inputTanggalPelaksanaanEvent" name="tanggal_pelaksanaan" value="{{ $event[0]->tanggal_pelaksanaan }}">
                                @error('tanggal_pelaksanaan')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputWaktuMulaiEvent" class="col-sm-2 col-form-label">Waktu Mulai</label>
                            <div class="col-sm-10">
                                <input type="time"  class="form-control" id="inputWaktuMulaiEvent" name="jam_mulai" value="{{  $event[0]->jam_mulai }}">
                                @error('jam_mulai')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputWaktuSelesaiEvent" class="col-sm-2 col-form-label">Waktu Selesai</label>
                            <div class="col-sm-10">
                                <input type="time"  class="form-control" id="inputWaktuSelesaiEvent" name="jam_selesai" value="{{ $event[0]->jam_selesai }}">
                                @error('jam_selesai')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputPICEvent" class="col-sm-2 col-form-label">PIC</label>
                            <div class="col-sm-10">
                                <select class="form-select form-control" id="inputPICEvent" name="id_pic">
                                    @forelse ($pic as $personincharge)
                                        <option value="{{ $personincharge->id_pic }}" {{  $event[0]->id_pic == $personincharge->id_pic ? "selected" : ""}}>
                                            <span class="namaPIC">{{ $personincharge->nama_dosen }}</span> - <span class="prodiPIC">{{ $personincharge->prodi }}</span>
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('id_pic')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                            </div>

                        <div class="row mb-3">
                            <label for="inputProposalEvent" class="col-sm-2 col-form-label">Proposal</label>
                            <div class="col-sm-10">
                                <select class="form-select form-control" id="inputProposalEvent" name="id_proposal">
                                    @forelse ($proposal as $p)
                                    <option value="{{ $p->id_proposal }}" {{ $event[0]->id_proposal == $p->id_proposal ? 'selected' : '' }}>
                                        <span class="id-proposal">{{ $p->id_proposal }}</span> -
                                        <span class="mata-kuliah">{{ $p->mata_kuliah }}</span> -
                                        <span class="waktu-pengunggahan">{{ $p->waktu_pengunggahan }}</span>
                                    </option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('id_proposal')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>


                        <button type="submit" class="btn btn-outline-warning m-2 float-end">Update Event</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Event Ends -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection
