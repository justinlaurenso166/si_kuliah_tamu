@extends('website-for-user.partials-main.main')
@section('css')
<link rel="stylesheet" href="/assets-user/css/style-presensi.css">
@endsection

@section("main")
<div class="container" style="margin-top: 150px;">
    <h5>PRESENSI</h5>

    <br>

    <p><b>Kuliah Tamu </b> "<span class="nama_event">{{ $pembicara[0]->nama_event }}</span>" - <span class="tanggal_pelaksanaan">{{ $pembicara[0]->tanggal_pelaksanaan }}</span></p>
    <p><b>Pembicara : </b>
        <span class="nama_pembicara">
            @foreach ($pembicara as $p)
            @if ($loop->last)
            {{ $p->nama }}
            @else
            {{ $p->nama }},
            @endif
            @endforeach
            {{-- {{ $pembicara[0]->nama }} --}}
        </span>
    </p>

    <br>

    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert" >
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('eventuser.store', $pembicara[0]->id_event)}}" method='POST'>
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="row mb-3">
                    <label for="inputNIMMahasiswaUser" class="col-sm-2 col-form-label"><b>NIM :</b></label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="inputTanggalEvent" name="tanggal_pelaksanaan" value="{{ $pembicara[0]->tanggal_pelaksanaan }}">
                        <input type="hidden" class="form-control" id="inputJamMulaiEvent" name="jam_mulai" value="{{ $pembicara[0]->jam_mulai }}">
                        <input type="hidden" class="form-control" id="inputJamSelesaiEvent" name="jam_selesai" value="{{ $pembicara[0]->jam_selesai}}">
                        <input type="text" class="form-control" id="inputNIMMahasiswaUser" name="nim">
                        @error('nim')
                            <p class="text-danger"><i>{{ $message }}</i></p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <br>
        <p><b>Check your data before submitting your attendance</b></p>
        <br>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="row mb-3">
                    <label for="DeteksiNamaUser" class="col-sm-2 col-form-label"><b>Name :</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="DeteksiNamaUser" name="nama_mahasiswa" disabled>
                        @error('nama_mahasiswa')
                            <p class="text-danger"><i>{{ $message }}</i></p>
                        @enderror
                    </div>
                </div>
                <br>

                <div class="row mb-3">
                    <label for="deteksiJenisKelaminUser" class="col-sm-2 col-form-label"><b>Gender :</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="deteksiJenisKelaminUser" name="jenis_kelamin" disabled>
                        @error('jenis_kelamin')
                            <p class="text-danger"><i>{{ $message }}</i></p>
                        @enderror
                    </div>
                </div>
                <br>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="row mb-3">
                    <label for="deteksiProdiUser" class="col-sm-2 col-form-label"><b>Major :</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="deteksiProdiUser" name="prodi" disabled>
                        @error('nama_mahasiswa')
                            <p class="text-danger"><i>{{ $message }}</i></p>
                        @enderror
                    </div>
                </div>
                <br>

                <div class="row mb-3">
                    <label for="deteksiAngkatanUser" class="col-sm-2 col-form-label"><b>Year :</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="deteksiAngkatanUser" name="angkatan" disabled>
                        @error('angkatan')
                            <p class="text-danger"><i>{{ $message }}</i></p>
                        @enderror
                    </div>
                </div>
                <br>
            </div>

            <div class="col-12 d-flex justify-content-center" style="margin-bottom: 50px">
                <button type="submit" class="btn btn-outline-warning w-100">Submit</button>
            </div>

        </div>
    </form>

    <div class="button">
        <div class="col-12 button-back-to-article" style="margin-bottom : 20px;">
            <a><button class="button-for-back" onclick="history.back()">Back</button></a>
        </div>
    </div>
</div>
<!-- End of Documentation -->
@endsection

@section('js')
<script>
    let nim  = document.getElementById('inputNIMMahasiswaUser');
    nim.addEventListener('change', function() {
        fetch('/user/presensi/nim/' + nim.value)
        .then(response => response.json())
        .then(data => {
            document.getElementById('DeteksiNamaUser').value = data.nama_mahasiswa;
            document.getElementById('deteksiJenisKelaminUser').value = data.jenis_kelamin;
            document.getElementById('deteksiProdiUser').value = data.prodi;
            document.getElementById('deteksiAngkatanUser').value = data.angkatan;
        })
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> --}}
<script src ="./assets/js/script.js"></script>
<script src ="/assets-user/js/script-datepicker.js"></script>
@endsection
