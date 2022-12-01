@extends('dashboard-admin.partials-main.main')

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Custom CSS by Group 2 -->
    <link href="/assets/css/style-search-article.css" rel="stylesheet">
@endsection

@section('main')
    @if (session()->has('success'))
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif
    <div class="container-fluid pt-4 px-4">
        <div class="top-article">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h5 class="mb-0" style="margin-top: 10px;">Artikel Kuliah Tamu</h5>
            </div>
            <div class="search-area">
                <form class="search-article" action="{{ route('post.index') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="search" class="form-control rounded" placeholder="Search for article.." aria-label="Search" aria-describedby="search-addon" style="width:190px;" name="search" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-warning">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@forelse ( $posts as $p )
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <img src = "{{ $p->foto }}" alt="foto" class="article-photo">
                        <div class="article-detail">
                            <p class = "tanggal">{{ date("M-d-Y",strtotime($p->waktu_publikasi)) }}</p>
                            <p class = "judul">{{ $p->judul }}</p>
                            <p class = "author"> {{ "Penulis : " . $p->author }}</p>
                            <p class = "isi">{{ Str::limit($p->ringkasan, 140, ' ...') }}</p>
                        </div>
                    </div>

                    <div class="col-12" style="padding-top: 10px">
                        <div class="d-flex" style="margin-bottom: 10px">
                            <a class="btn btn-sm btn-outline-info w-50" href="{{ route('post.show',$p->id_posts) }}">Show</a>
                            <a class="btn btn-sm btn-outline-warning w-50" href="{{ route('post.edit',$p->id_posts) }}">Edit</a>
                        </div>
                        <div class="gap">
                            <form action="{{ route('post.destroy',$p->id_posts) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger w-100">Delete</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@empty

@endforelse

    <!-- Artikel Starts -->

    <div class="col-sm-12 d-flex justify-content-center" style="margin-top: 10px">
        {{ $posts->links() }}
    </div>
    <!-- Artikel Ends -->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
