@extends('website-for-user.partials-main.main')
@section('css')
    <link rel="stylesheet" href="/assets-user/css/style-documentation.css">
@endsection

@section('main')
    <!-- Documentation Starts Here -->
    <div class="container">
        <div class="row">
            <div class="col-12 top-documentation">
                <h1 class="judul">DOKUMENTASI</h1>
                <div class="search-area">
                    <form class="search-documentation" action='{{ route('documentationuser.index') }}' method='get'>
                        <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Search for Documentation.." aria-label="Search" aria-describedby="search-addon" style="width:250px;" name="search" value="{{ old('search') }}">
                        <button type="submit" class="btn btn-outline-warning">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            @foreach ($dokumentasi as $d)
                <div class="col-md-6 col-sm-12 col-12">
                    <a href="/user/documentation/{{ $d->id_dokumentasi }}" class="design-kt">
                        <p style="text-align:justify; width:90%"><span class="nama_event">{{ $d->nama_event }}</span></p>
                        <img src = "{{ $d->foto }}" alt= "foto" class ="documentation-photo">
                    </a>
                </div>
            @endforeach

            {{-- <div class="col-md-6 col-sm-12 col-12">
                <a href="documentation-inside.html" class="design-kt">
                    <p>Kuliah Tamu 1</p>
                    <img src = "https://career.summarecon.com/public/images/post/big/executive-secretary-to-pradita-institute.jpg" alt= "foto" class ="documentation-photo">
                </a>
            </div>

            <div class="col-md-6 col-sm-12 col-12">
                <a href="#" class="design-kt">
                    <p>Kuliah Tamu 2</p>
                    <img src = "https://1.bp.blogspot.com/--49t2cS6msE/UxHH-LbezPI/AAAAAAAAAFM/xExKy8Y3bp0/s320/css+image+effects-square+photo+frame.png" alt= "foto" class ="documentation-photo">
                </a>
            </div>

            <div class="col-md-6 col-sm-12 col-12">
                <a href="#" class="design-kt">
                    <p>Kuliah Tamu 3</p>
                    <img src = "https://i.stack.imgur.com/ZBhxv.jpg" alt= "foto" class ="documentation-photo">
                </a>
            </div>

            <div class="col-md-6 col-sm-12 col-12">
                <a href="#" class="design-kt">
                    <p>Kuliah Tamu 4</p>
                    <img src = "https://career.summarecon.com/public/images/post/big/executive-secretary-to-pradita-institute.jpg" alt= "foto" class ="documentation-photo">
                </a>
            </div>

            <div class="col-md-6 col-sm-12 col-12">
                <a href="#" class="design-kt">
                    <p>Kuliah Tamu 5</p>
                    <img src = "https://cdn.popbela.com/content-images/post/20210719/twittercom-wonubliss-da3451881050349e34da579bdf0af5db.jpg" alt= "foto" class ="documentation-photo">
                </a>
            </div>

            <div class="col-md-6 col-sm-12 col-12">
                <a href="#" class="design-kt">
                    <p>Kuliah Tamu 6</p>
                    <img src = "https://career.summarecon.com/public/images/post/big/executive-secretary-to-pradita-institute.jpg" alt= "foto" class ="documentation-photo">
                </a>
            </div>

            <div class="col-md-6 col-sm-12 col-12">
                <a href="#" class="design-kt">
                    <p>Kuliah Tamu 7</p>
                    <img src = "https://sportshub.cbsistatic.com/i/2021/11/25/e738e9b4-9d4f-435b-ba98-63ad11272894/we-baby-bears-trailer-spinoff-cartoon-network.jpg" alt= "foto" class ="documentation-photo">
                </a>
            </div>

            <div class="col-md-6 col-sm-12 col-12">
                <a href="#" class="design-kt">
                    <p>Kuliah Tamu 8</p>
                    <img src = "https://career.summarecon.com/public/images/post/big/executive-secretary-to-pradita-institute.jpg" alt= "foto" class ="documentation-photo">
                </a>
            </div>

            <div class="col-md-6 col-sm-12 col-12">
                <a href="#" class="design-kt">
                    <p>Kuliah Tamu 9</p>
                    <img src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEhoFFHdHJsEnkEskEeFX4slaxfstFmu2u_w&usqp=CAU" alt= "foto" class ="documentation-photo">
                </a>
            </div>

            <div class="col-md-6 col-sm-12 col-12">
                <a href="#" class="design-kt">
                    <p>Kuliah Tamu 10</p>
                    <img src = "https://irs.www.warnerbros.com/hero-banner-jpeg/movies/media/browser/we_bare_bears_the_movie_4320x1080.jpg" alt= "foto" class ="documentation-photo">
                </a>
            </div> --}}

            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center" style="margin-top: 10px">
                    {{-- @dd($dokumentasi->links()) --}}
                    {{ $dokumentasi->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- End of Documentation -->
@endsection

@section('js')
    <!--Bootstrap JS Bundle + Separate-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src ="/assets/js/script.js"></script>
@endsection
