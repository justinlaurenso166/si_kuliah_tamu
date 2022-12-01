@extends('website-for-user.partials-main.main')
@section('css')
    <link rel="stylesheet" href="/assets-user/css/style-index.css">
@endsection

@section('main')
<div class="container" style="margin-top:150px; margin-bottom:30px; background-color: rgb(250, 250, 250); border-radius: 30px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
    <div class="container" style="padding-bottom: 30px">
        <h4 style="padding-top: 30px">Profile Mahasiswa</h4>
        <br>
        <div class="mb-3 row">
            <label for="" class="col-sm-2 col-form-label" style="margin-top: 20px;"><b>NIM</b></label>
            <div class="col-sm-10">
                <label class="col-form-label col-sm-10" style="margin-top: 20px;">{{ $mahasiswa->nim }}</label>
            </div>

            <label for="" class="col-sm-2 col-form-label" style="margin-top: 20px;"><b>Nama Mahasiswa</b></label>
            <div class="col-sm-10">
                <label class="col-form-label col-sm-10" style="margin-top: 20px;">{{ $mahasiswa->nama_mahasiswa}}</label>
            </div>

            <label for="" class="col-sm-2 col-form-label" style="margin-top: 20px;"><b>Jenis Kelamin</b></label>
            <div class="col-sm-10">
                <label class="col-form-label col-sm-10" style="margin-top: 20px;">{{ $mahasiswa->jenis_kelamin }}</label>
            </div>

            <label for="" class="col-sm-2 col-form-label" style="margin-top: 20px;"><b>Prodi</b></label>
            <div class="col-sm-10">
                <label class="col-form-label col-sm-10" style="margin-top: 20px;">{{ $mahasiswa->prodi }}</label>
            </div>

            <label for="" class="col-sm-2 col-form-label" style="margin-top: 20px;"><b>Angkatan</b></label>
            <div class="col-sm-10">
                <label class="col-form-label col-sm-10" style="margin-top: 20px;">{{ $mahasiswa->angkatan }}</label>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
    <!--Bootstrap JS Bundle + Separate-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src ="/assets-user/js/script.js"></script>
@endsection
