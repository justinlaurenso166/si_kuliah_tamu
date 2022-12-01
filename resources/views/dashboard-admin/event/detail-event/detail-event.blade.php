@extends('dashboard-admin.partials-main.main')

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">

    <!-- Template Stylesheet -->
    <link href="/assets/css/style-detail-event.css" rel="stylesheet">
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

    <!-- Event Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Data Event Kuliah Tamu</h6>
            </div>
            <div class="table-responsive">
                <table border="0" cellspacing="5" cellpadding="5" style="margin-bottom: 20px;">
                    <tbody class="d-flex justify-content-center">
                        <tr>
                            <td>Minimum date:</td>
                            <td><input type="text" id="min" name="min" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Maximum date:</td>
                            <td><input type="text" id="max" name="max" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>

                <table id="example" class="display" style="text-align: center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Event</th>
                            <th scope="col">Nama Event</th>
                            <th scope="col">Cara Pelaksanaan</th>
                            <th scope="col">Tanggal Pelaksanaan</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Durasi</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Pembicara</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Event</th>
                            <th scope="col">Nama Event</th>
                            <th scope="col">Cara Pelaksanaan</th>
                            <th scope="col">Tanggal Pelaksanaan</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Durasi</th>
                            <th scope="col">PIC</th>
                            <th scope="col">Pembicara</th>
                            <th scope="col">Details</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @forelse ($event as $e)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $e->id_event }}</td>
                                <td>{{ $e->nama_event }}</td>
                                <td>{{ $e->cara_pelaksanaan }}</td>
                                <td>{{ $e->tanggal_pelaksanaan }}</td>
                                <td>{{ date('H:i',strtotime($e->jam_mulai))}}</td>
                                <td>{{ date('G \j\a\m i \m\e\n\i\t', strtotime($e->jam_selesai) - strtotime($e->jam_mulai))}}</td>
                                <td>{{ $e->nama_dosen }}</td>
                                <td>
                                    @forelse ($e->pembicara as $p)
                                        {{ $p->nama }}<br>
                                    @empty

                                    @endforelse
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-sm btn-outline-info" href="{{ route('event.index') . '?id_event=' . $e->id_event}}">Detail</a>
                                    <a class="btn btn-sm btn-outline-warning" href="{{ route('event.edit', $e->id_event) }}">Edit</a>
                                    <form action="{{ route("event.destroy", $e->id_event)}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
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
    <!-- Event End -->


    @if ($singleEvent != null)
    <!-- Data Detail Event Starts Here -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-justify rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Data Event - <span class="nama-event">{{ $singleEvent->nama_event }}</span></h6>
            </div>

            <div class="row">
                <div class="col-12" style="margin-bottom:30px">
                    <dl class="row mb-0 d-flex">
                        <dt class="col-sm-4">Cara Pelaksanaan</dt>
                        <dd class="col-sm-8">{{ $singleEvent->cara_pelaksanaan }}</dd>

                        <dt class="col-sm-4">Tempat/Media Pelaksanaan</dt>
                        <dd class="col-sm-8">{{ $singleEvent->tempat_pelaksanaan }}</dd>

                        <dt class="col-sm-4">Link</dt>
                        <dd class="col-sm-8">
                            @if ($singleEvent->link == null)
                                -
                            @endif
                            {{ $singleEvent->link }}
                        </dd>

                        <dt class="col-sm-4">Estimasi Waktu</dt>
                        <dd class="col-sm-8"><span class="jam_mulai">{{ date('H:i',strtotime($singleEvent->jam_mulai)) }}</span> - <span class="jam_selesai">{{ date('H:i',strtotime($singleEvent->jam_selesai)) }}</span> WIB</dd>

                        <dt class="col-sm-4">Pembicara</dt>
                        <dd class="col-sm-8">
                            <a class="btn btn-sm btn-outline-info w-100" style="margin-bottom: 5px" href="{{ route("event.editPembicara", $singleEvent->id_event) }}">Input Pembicara</a>
                            <br>
                                @forelse ($singleEvent->pembicara as $p)
                                <div class="d-flex justify-content-between align-content-center" style="margin-bottom: 5px">
                                    {{ $p->nama }}<br>
                                    <div class="d-flex">
                                        <a class="btn btn-sm btn-outline-warning" href="{{ route("event.editSertifikat", [$singleEvent->id_event, $p->id_pembicara]) }}">Tambah Sertifikat</a>
                                        <form action="/admin/event/{{$singleEvent->id_event}}/pembicara/{{$p->id_pembicara}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                                        </form>
                                    </div>

                                </div>
                                @empty
                                @endforelse


                        </dd>

                        <dt class="col-sm-4">Laporan Akhir</dt>
                        <dd class="col-sm-8">
                            <a class="btn btn-sm btn-outline-info" href="{{ route("event.editLaporanAkhir", $singleEvent->id_event) }}">
                                @if ($singleEvent->laporan_akhir == null)
                                    Input Laporan Akhir
                                @else
                                    Edit Laporan Akhir
                                @endif
                            </a>
                            @if ($singleEvent->laporan_akhir != null)
                            <a class="btn btn-sm btn-outline-warning" href="{{ route('download.index') }}?file={{  $singleEvent->laporan_akhir }}">Download</a>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Proposal</dt>
                        <dd class="col-sm-8">
                            <a class="btn btn-sm btn-outline-warning" href="{{ route('download.index') }}?file={{  $singleEvent->file_proposal }}">Download</a>
                        </dd>
                    </dl>
                </div>
                <div class="col-12 col-sm-12 col-md-6" style="margin-top:30px">
                    <h6 class="text-center" style="margin-bottom: 20px;">Background</h6>
                    <div class="group-contains d-flex justify-content-center">
                        {{-- <img class="img-fluid  mx-auto  bg-flyer-photo" src="{{ asset("storage/" . $singleEvent->background) }}"> --}}
                        <img class="img-fluid  mx-auto  bg-flyer-photo" src="{{ asset($singleEvent->background) }}">
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6" style="margin-top:30px">
                    <h6 class="text-center" style="margin-bottom: 20px;">Flyer</h6>
                    <div class="group-contains d-flex justify-content-center">
                        {{-- <img class="img-fluid  mx-auto  bg-flyer-photo" src="{{ asset("storage/" . $singleEvent->flyer) }}"> --}}
                        <img class="img-fluid  mx-auto  bg-flyer-photo" src="{{ asset($singleEvent->flyer) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Detail Event Ends Here -->
    @endif

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

    <script>
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[4] );

                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#max'), {
                format: 'YYYY-MM-DD'
            });

            // DataTables initialisation
            var table = $('#example').DataTable();

            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
            });
        });
    </script>
@endsection
