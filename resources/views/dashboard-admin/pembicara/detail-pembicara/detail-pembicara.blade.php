@extends('dashboard-admin.partials-main.main')

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Custom CSS by Group 2 -->
    <link href="/assets/css/style-detail-pembicara.css" rel="stylesheet">
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
    <!-- Data Pembicara Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Pembicara Kuliah Tamu</h6>
            </div>


            <div class="table-responsive">
                <table id="example" class="display" style="text-align: center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Pembicara</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Institusi</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Pembicara</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Institusi</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Details</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @forelse ($pembicara as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->id_pembicara }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->institusi }}</td>
                            <td>{{ $p->jabatan }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('pembicara.index') . '?id_pembicara=' . $p->id_pembicara }}" class="btn btn-sm btn-outline-info">Detail</a>
                                <a class="btn btn-sm btn-outline-warning w-100" href="{{ route("pembicara.edit", $p->id_pembicara) }}">Edit</a>
                                <form action="{{ route('pembicara.destroy', $p->id_pembicara) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Data Pembicara Ends -->

    @if ($singlePembicara != null)
    <!-- Data Detail Pembicara Starts Here -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-justify rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Data Detail Pembicara</h6>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-12 d-flex justify-content-center">
                    <img class="img-fluid  mx-auto  pembicara-photo" src="{{ asset($singlePembicara[0]->foto) }}">
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="bg-light rounded h-100">
                        <h6 class="mb-4"><span class="nama-pembicara">{{ $singlePembicara[0]->nama }}</span></h6>
                        <dl class="row mb-0">
                            <dt class="col-sm-4 institusi-pembicara">Institusi</dt>
                            <dd class="col-sm-8 isi-institusi-pembicara">{{ $singlePembicara[0]->institusi }}</dd>

                            <dt class="col-sm-4">Jabatan</dt>
                            <dd class="col-sm-8">{{ $singlePembicara[0]->jabatan }}</dd>

                            <dt class="col-sm-4">NPWP</dt>
                            <dd class="col-sm-8">
                                @if ($singlePembicara[0]->npwp == null)
                                    -
                                @else
                                {{ $singlePembicara[0]->npwp }}
                                @endif

                            </dd>

                            <dt class="col-sm-4">Bank</dt>
                            <dd class="col-sm-8">
                                @if ($singlePembicara[0]->bank == null)
                                    -
                                @else
                                {{ $singlePembicara[0]->bank }}
                                @endif
                            </dd>

                            <dt class="col-sm-4">No. Rekening</dt>
                            <dd class="col-sm-8">
                                @if ($singlePembicara[0]->no_rekening == null)
                                    -
                                @else
                                {{ $singlePembicara[0]->no_rekening }}
                                @endif
                            </dd>

                            <dt class="col-sm-4">CV</dt>
                            <dd class="col-sm-8"><a class="btn btn-sm btn-outline-warning" href="{{ route('download.index') }}?file={{ $singlePembicara[0]->cv }}">Download CV</a></dd>

                        </dl>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif
    <!-- Data Detail Pembicara Ends Here -->


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
