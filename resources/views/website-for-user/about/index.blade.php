@extends('website-for-user.partials-main.main')
@section('css')
    <link rel="stylesheet" href="/assets-user/css/style-index.css">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection

@section('main')
    <!-- Carousel -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" style="z-index:-10000000;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="/assets-user/img/carousel1fix.jpg" class="d-block w-100 carousel-img" alt="carousel">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="/assets-user/img/carousel2fix.jpg" class="d-block w-100 carousel-img" alt="carousel">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="/assets-user/img/carousel3fix.jpg" class="d-block w-100 carousel-img" alt="carousel">
                <div class="carousel-caption d-none d-md-block"></div>
            </div>
        </div>
    </div>

    <!-- End of Carousel -->
    <br>
    <br>

    {{-- Summary Mulai --}}
    <div class="container">
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

    {{-- Summary Selesai --}}

    <br>
    <br>

    <!-- Introduction -->
    <section id="introduction">
        <div class="container">
            <div class="row">
            <div class="col">
                <h3>INTRODUCTION</h3>
                <p class="introduction">
                    Universitas Pradita turut serta dalam memajukan bangsa dalam bidang pendidikan dengan mengadakan event kuliah tamu dari berbagai mitra di seluruh penjuru dunia. Dengan adanya event-event ini Universitas Pradita berharap dapat
                    membuka mata mahasiswa serta mengembangkan skill yang ada. Project ini kami rancang agar memberi kemudahan terhadap akses event-event kuliah tamu yang telah Universitas Pradita adakan selama beberapa tahun terakhir.
                </p>
            </div>
            </div>
        </div>
    </section>
    <!-- End of Introduction -->
    <br>
    <!-- Members -->

    <section class="group">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>GROUP MEMBERS</h3>
                    <br>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="profiles">
                        <div class="profile">
                            <img src="/assets-user/img/claudio.png" class="profile-img">

                            <div class="description-profile">
                                <h5 class="user-name">Claudio Stevant Effendi</h5>
                                <h6>2110101007</h6>
                                <p>Teknik Informatika</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="profiles">
                        <div class="profile">
                            <img src="/assets-user/img/darren.png" class="profile-img">

                            <div class="description-profile">
                                <h5 class="user-name">Darren Valentio</h5>
                                <h6>2110101009</h6>
                                <p>Teknik Informatika</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="profiles">
                        <div class="profile">
                            <img src="/assets-user/img/patricia.png" class="profile-img">

                            <div class="description-profile">
                                <h5 class="user-name">Patricia Ho</h5>
                                <h6>2110101015</h6>
                                <p>Teknik Informatika</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="profiles">
                        <div class="profile">
                            <img src="/assets-user/img/sheila.png" class="profile-img">

                            <div class="description-profile">
                                <h5 class="user-name">Gabrielle Sheila Sylvagno</h5>
                                <h6>2110101018</h6>
                                <p>Teknik Informatika</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="profiles">
                        <div class="profile">
                            <img src="/assets-user/img/grace.png" class="profile-img">

                            <div class="description-profile">
                                <h5 class="user-name">Grace Sally</h5>
                                <h6>2110101038</h6>
                                <p>Teknik Informatika</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Members -->
@endsection

@section('js')
    <!--Bootstrap JS Bundle + Separate-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src ="/assets-user/js/script.js"></script>
@endsection
