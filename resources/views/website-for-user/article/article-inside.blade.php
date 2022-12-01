@extends('website-for-user.partials-main.main')
@section('css')
    <link rel="stylesheet" href="/assets-user/css/style-article-inside.css">
@endsection

@section('main')
    <div class="container" >
        <div class="judul-artikel">{{ $post[0]->judul }}</div>
        <div class="nama-author">Penulis : {{ $post[0]->author }}</div>
        <div class="waktu-publish">Dipublikasikan {{ $post[0]->waktu_publikasi }}</div>
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @forelse ($post as $p)
                        <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                            <img class="img-fluid mx-auto documentation-photo" src="{{ asset($p->foto) }}">
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-12">
                <p class = "isi">{{ $post[0]->ringkasan }}</p>
            </div>

            <div class="button">
                <div class="col-12 button-back-to-article" style="margin-bottom : 20px;">
                    <a><button class="button-for-back" onclick="history.back()">Back</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}
    <script src ="./assets/js/script.js"></script>
@endsection
