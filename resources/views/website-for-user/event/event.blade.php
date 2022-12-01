@extends('website-for-user.partials-main.main')
@section('css')
    <link rel ="stylesheet" href ="/assets-user/css/style-event.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection


@section('main')
    <!-- Event Start -->
        <div class="container">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert" >
                    {{ session('success') }}
                </div>
            @endif

            <div class="top-event" style="margin-bottom: 30px">
                <h1 class="event-section" style="margin-bottom: 30px">EVENT LIST</h1>
                <div class="search-area">
                    <form class="search-event" action='{{ route('eventuser.index')}}' method='get'>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="date-picker input-group">
                                    <input id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; height:38px; border-radius: 3px;" name="date_search">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="input-group">
                                    <input type="search" class="form-control rounded search-bar-for-event" placeholder="Search for event.." aria-label="Search" aria-describedby="search-addon" name="search">
                                    <button type="submit" class="btn btn-outline-warning">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark" style="background-color:#FFE6C2; text-align: center; vertical-align:middle;">
                            <th scope="col">Num.</th>
                            <th scope="col">ID Event</th>
                            <th scope="col">Nama Event</th>
                            <th scope="col">Cara Pelaksanaan</th>
                            <th scope="col">Tempat Pelaksanaan</th>
                            <th scope="col">Link</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Durasi</th>
                            @if (auth()->guest() != true)
                                <th scope="col">Presensi</th>
                            @endif
                            <th scope="col">Pembicara</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event as $e)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $e->id_event }}</td>
                            <td>{{ $e->nama_event }}</td>
                            <td>{{ $e->cara_pelaksanaan }}</td>
                            <td>{{ $e->tempat_pelaksanaan }}</td>
                            <td><a class="btn btn-sm btn-outline-success w-100" href="{{ $e->link }}">Enter The Event</a></td>
                            <td>{{ $e->tanggal_pelaksanaan }}</td>
                            <td><span class="jam_mulai">{{ date('H:i',strtotime($e->jam_mulai)) }}</span> - <span class="jam_selesai">{{  date('H:i',strtotime($e->jam_selesai)) }}</td>
                            <td>{{ date('G \j\a\m i \m\e\n\i\t', strtotime($e->jam_selesai) - strtotime($e->jam_mulai))}}</td>
                            @if (auth()->guest() != true)
                            <td><a class="btn btn-sm btn-outline-warning w-100" href="{{ route('eventuser.create', $e->id_event) }}">Presensi</a></td>
                            @endif
                            {{-- nanti diloop --}}
                            <td>
                            @foreach ($e->pembicara as $p)
                                <a class="btn btn-sm btn-outline-info w-100" href="/user/eventuser/{{ $p->id_pembicara }}">{{ $p->nama }}<br></a>
                            @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center" style="margin-top: 10px">
                    {{ $event->links() }}
                </div>
            </div>

        </div>
    <!-- Event End -->
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> --}}
<script src ="./assets/js/script.js"></script>
<script src ="/assets-user/js/script-datepicker.js"></script>
@endsection
