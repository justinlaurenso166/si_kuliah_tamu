@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Dashboard 4 Grid Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jumlah Kuliah Tamu</p>
                        <h6 class="mb-0">{{ $event[0]->jumlah_kuliah_tamu }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jumlah Mahasiswa</p>
                        <h6 class="mb-0">{{ $mahasiswa[0]->jumlah_mahasiswa }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jumlah Artikel Post</p>
                        <h6 class="mb-0">{{ $posts[0]->jumlah_post }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jumlah Dokumentasi</p>
                        <h6 class="mb-0">{{ $dokumentasi[0]->jumlah_dokumentasi }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard 4 Grid End -->

    <!-- Kuliah Tamu Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Tata Cara</h6>
            </div>
            <p><b>Selamat datang di dashboard admin kuliah tamu Pradita University!</b></p>
            <p>Silahkan ikuti petunjuk berikut untuk mendata event</p>
            <ol>
                <li>Masukkan terlebih dahulu proposal</li>
                <li>Masukkan PIC yang bersangkutan dalam event tersebut.<b>*</b></li>
                <li>Masukkan data event kuliah tamu yang akan diselenggarakan (dibagian ini admin perlu menaruh proposal yang bersangkutan)</li>
                <li>Daftarkan pembicara yang bersangkutan<b>*</b></li>
                <li>Masukkan pembicara ke dalam event tertentu<b>**</b></li>
            </ol>
            <p>
                <i><b>*</b> = Jika sudah ditambahkan sebelumnya, maka tahap ini bisa dilewati</i>
                <br>
                <i><b>**</b> = Pada section event, pilih salah satu event terlebih dahulu dengan mengklik tombol detail</i>
            </p>

            <hr>

            <p>Untuk data mahasiswa, perlu ditambahkan terlebih dahulu!</p>

            <p>Setelah event sudah terlaksana, ikuti petunjuk berikut!</p>
            <ol>
                <li>Masukkan laporan akhir event pada section event.<b>**</b></li>
                <li>Masukkan dokumentasi berupa foto atau video (foto maksimal 2 dan link video maksimal 1 ). Jangan lupa pilih event yang bersangkutan.</li>
                <li>Jika ingin mengetik ringkasan yang ada pada event, masukkan ke dalam bagian posts.</li>
            </ol>
            <p><i><b>**</b> = Pada section event, pilih salah satu event terlebih dahulu dengan mengklik tombol detail</i></p>

            <hr>

            <p>Semua pengguna yang terdaftar hanya pihak yang bersangkutan dengan Pradita University. <br>Semua pengguna baru akan didaftarkan oleh pihak admin Pradita University!</p>
        </div>
    </div>
    <!-- Kuliah Tamu End -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection
