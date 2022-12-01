@extends('dashboard-admin.partials-main.main')
@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
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

    <!-- Data Mahasiswa Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Data Mahasiswa</h6>
            </div>


            <div class="table-responsive">
                <table id="example" class="display" style="text-align: center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Nama Mahasiswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Details</th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @forelse ( $mahasiswa as $m)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $m->nim }}</td>
                                <td>{{ $m->nama_mahasiswa }}</td>
                                <td>{{ $m->jenis_kelamin }}</td>
                                <td>{{ $m->prodi }}</td>
                                <td>{{ $m->angkatan }}</td>
                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-sm btn-outline-info w-100" href="{{ route("mahasiswa.edit", $m->nim) }}">Edit</a>
                                    <form action="{{ route("mahasiswa.destroy", $m->nim)}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
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
    <!-- Data Mahasiswa Ends -->

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
