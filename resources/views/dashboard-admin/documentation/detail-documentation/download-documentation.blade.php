@extends('dashboard-admin.partials-main.main')

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Custom CSS by Group 2 -->
    <link href="/assets/css/style-download-documentation.css" rel="stylesheet">
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
    <!-- Data Dokumentasi Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Dokumentasi Event</h6>
            </div>


            <div class="table-responsive">
                <table id="example" class="display" style="text-align: center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Dokumentasi</th>
                            <th scope="col">Nama Event</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Dokumentasi</th>
                            <th scope="col">Nama Event</th>
                            <th scope="col">Details</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @forelse ($documentation as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->id_dokumentasi }}</td>
                                <td>{{ $d->nama_event }}</td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-sm btn-outline-info" href="{{ route('documentation.index') . '?id_dokumentasi=' . $d->id_dokumentasi  }}">Detail</a>
                                    <a class="btn btn-sm btn-outline-warning" href="{{ route('documentation.edit',$d->id_dokumentasi) }}">Edit</a>
                                    <form action="{{ route("documentation.destroy", $d->id_dokumentasi)}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info text-center">
                                        <h5 class="text-center">Tidak ada data</h5>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Data Dokumentasi Ends -->

    @if ($singleDocumentation != null)
    <!-- Download Dokumentasi Starts Here -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-justify rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Download Dokumentasi</h6>
            </div>

            <div class="row">
                <div class="col-md-5 col-sm-12 d-flex justify-content-center">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        </div>

                        <div class="carousel-inner">
                            @forelse ($singleDocumentation as $d)
                            <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                                <img class="img-fluid mx-auto documentation-photo" src="{{ asset($d->foto) }}">
                            </div>
                            @empty

                            @endforelse
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <div class="col-md-7 col-sm-12">
                    <div class="bg-light rounded h-100">
                        <h6 class="mb-4"><span class="nama-pembicara">{{ $singleDocumentation[0]->nama_event}}</span></h6>
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Foto Dokumentasi</dt>
                            <dd class="col-sm-8 d-flex">
                                @forelse ($singleDocumentation as $d)
                                    <a class="btn btn-sm btn-outline-warning w-100" href="{{ route('download.index') }}?file={{ $d->foto }}">Download Foto {{ $loop->iteration }}</a>
                                @empty
                                @endforelse
                            </dd>

                            <dt class="col-sm-4">Video Dokumentasi</dt>
                            <dd class="col-sm-8">
                                @if ($singleDocumentation[0]->video == null)
                                <p>Belum ada video yang dimasukkan</p>
                                @else
                                <a class="btn btn-sm btn-outline-warning w-100" href="{{ $singleDocumentation[0]->video }}">Show Video</a>
                                @endif
                            </dd>

                            <dt class="col-sm-12" style="margin-bottom: 30px; margin-top: 30px;"></dt>

                            <dt class="col-sm-4">Feedback</dt>
                            <dd class="col-sm-8">
                                @if ($singleDocumentation[0]->feedback == null)
                                    -
                                @else
                                <a class="btn btn-sm btn-outline-warning w-100" href="{{ route('download.index') }}?file={{ $singleDocumentation[0]->feedback }}">Download Feedback</a>
                                @endif
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif
    <!-- Download Dokumentasi Ends Here -->

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
