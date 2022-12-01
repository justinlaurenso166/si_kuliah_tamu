@extends('dashboard-admin.partials-main.main')
@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('main')
    <!-- Data Presensi Mahasiswa Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Laporan Akhir Kuliah Tamu</h6>
            </div>


            <div class="table-responsive">
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Event</th>
                            <th scope="col">Nama Event</th>
                            <th scope="col">Jumlah Mahasiswa yang Hadir</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Event</th>
                            <th scope="col">Nama Event</th>
                            <th scope="col">Jumlah Mahasiswa yang Hadir</th>
                            <th scope="col">Details</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @forelse ($presensi as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->id_event }}</td>
                            <td>{{ $p->nama_event }}</td>
                            <td>{{ $p->jumlah_mahasiswa_hadir }}</td>
                            <td class="d-flex align-items-center">
                                <a class="btn btn-sm btn-outline-info w-100" href="{{ route('presensi.index') . '?id_event=' . $p->id_event }}">Detail</a>
                            </td>
                        </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Data Presensi End -->
    @if ($singlePresensi != null)
    <!-- Summary Presensi Grid Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12 col-sm-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jumlah Mahasiswa Presensi</p>
                        <h6 class="mb-0">{{ $summarySinglePresensi[0]->jumlah_mahasiswa_hadir }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2">Estimasi Waktu Presensi</p>
                        <h6 class="mb-0"><span class="jam_mulai">{{ date('H:i',strtotime($summarySinglePresensi[0]->jam_mulai)) }}</span> - <span class="jam_selesai">{{  date('H:i',strtotime($summarySinglePresensi[0]->jam_selesai)) }}</span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Summary Presensi Grid End -->

    <!-- Detail Presensi Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Detail Presensi - <span class="nama-event">{{ $singlePresensi[0]->nama_event }}</span></h6>
            </div>

            <div class="table-responsive">
                <table id="detail-presensi" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Waktu Presensi</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Waktu Presensi</th>
                        </tr>
                    </tfoot>

                    <tbody>

                            @forelse ($singlePresensi as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nim }}</td>
                                    <td>{{ $s->nama_mahasiswa }}</td>
                                    <td>{{ $s->waktu_presensi }}</td>
                                </tr>
                            @empty
                            @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Detail Presensi End -->
    @endif
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#detail-presensi').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );

        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
