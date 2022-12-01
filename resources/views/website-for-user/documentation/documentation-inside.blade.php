@extends('website-for-user.partials-main.main')
@section('css')
    <!-- Pop Up -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">

    <link rel="stylesheet" href="/assets-user/css/style-documentation-inside.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"> </script>
@endsection

@section('main')
    <div class="container" style="margin-top:150px">
        <div class="row">
            <div class="col-12 top-dokumentasi">
                <h1 class="judul">DOKUMENTASI</h1>
            </div>

            <!-- Documentation Picture Starts Here -->
            <div class="zoom-gallery">
                <h1 class="jenis-kuliah-tamu">Kuliah Tamu - {{ $dokumentasi[0]->nama_event }}</h1>
                <div class="row">
                    @if (count($dokumentasi) > 1)
                        @forelse ($dokumentasi as $d)
                        <div class="col-md-6 col-sm-12 col-12">
                            <a href="{{ $d->foto }}" class="foto-kuliahtamu" data-source="https://www.pradita.ac.id/student-facilities" title="Kuliah Tamu {{ $loop->iteration }}" style="width:193px;height:125px;">
                                <img src="{{ $d->foto }}" class="foto-dokumentasi">
                            </a>
                            <a class="btn btn-sm btn-outline-warning w-100" href="{{ route('download.index') }}?file={{ $d->foto }}">Download Foto {{ $loop->iteration }}</a>
                        </div>
                        @empty
                        @endforelse
                    @else
                    <div class="col-md-12 col-sm-12 col-12">
                        @forelse ($dokumentasi as $d)
                        <a href="{{ $d->foto }}" class="foto-kuliahtamu" data-source="https://www.pradita.ac.id/student-facilities" title="Kuliah Tamu {{ $loop->iteration }}" style="width:193px;height:125px;">
                            <img src="{{ $d->foto }}" class="foto-dokumentasi">
                        </a>
                        <a class="btn btn-sm btn-outline-warning w-100" href="{{ route('download.index') }}?file={{ $d->foto }}">Download Foto {{ $loop->iteration }}</a>
                        @empty
                        @endforelse
                    </div>
                    @endif

                </div>
            </div>

            @if ($dokumentasi[0]->video != null)
            <div class="col-md-12 col-sm-12" style="margin-top: 30px">
                <form class="button-download">
                    <a href="{{ $dokumentasi[0]->video }}" download class="btn btn-outline-warning w-100" role="button" aria-pressed="true">Download Video Dokumentasi</a>
                </form>
            </div>
            @endif

            <div class="button" style="margin-top: 30px">
                <div class="col-12 button-back-to-article" style="margin-bottom : 20px;">
                    <a><button class="button-for-back" onclick="history.back()">Back</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src ="/assets-user/js/script-magnetic-popup.js"></script>
    <script src ="/assets-user/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
@endsection
