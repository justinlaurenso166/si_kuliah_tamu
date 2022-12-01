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
                <h6 class="mb-0">Data Admin</h6>
            </div>


            <div class="table-responsive">
                <table id="example" class="display" style="text-align: center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Username</th>
                            <th scope="col"></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        @forelse ( $user as $u)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $u->id }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->username }}</td>
                                <td class="d-flex justify-content-center">
                                    <form action="{{ route("registeradmin.destroy", $u->id)}}" method="POST">
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
