@extends('dashboard-admin.partials-main.main')

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Custom CSS By Kelompok 2 -->
    <link href="./assets/css/style-proposal.css" rel="stylesheet">
@endsection

@section('main')
    @if (session()->has('success'))
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded p-4">
                <div class="alert alert-success col-lg-12" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <!-- Data Proposal Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Proposal Kuliah Tamu</h6>
            </div>


            <div class="table-responsive">
                <table id="example" class="display" style="text-align: center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Proposal</th>
                            <th scope="col">Mata Kuliah</th>
                            <th scope="col">Details</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th scope="col">Num.</th>
                            <th scope="col">ID Proposal</th>
                            <th scope="col">Mata Kuliah</th>
                            <th scope="col">Details</th>
                        </tr>
                    </tfoot>

                    <tbody>

                        @forelse ( $proposal as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->id_proposal }}</td>
                                <td>{{ $p->mata_kuliah }}</td>

                                <td class="d-flex justify-content-center">
                                    <a class="btn btn-sm btn-outline-info" href="{{ route('proposal.index') . '?id_proposal=' . $p->id_proposal }}">Detail</a>
                                    <a class="btn btn-sm btn-outline-warning" href="{{ route('proposal.edit',$p->id_proposal) }}">Edit</a>
                                    <form action="{{ route("proposal.destroy", $p->id_proposal)}}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
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
    <!-- Data Proposal End -->

    @if ($singleProposal != null)
        <!-- Detail Proposal Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Latar Belakang dan Tujuan Kegiatan -
                        <span class="Mata Kuliah">{{ $singleProposal[0]->mata_kuliah }}</span>
                    </h6>
                    <a class="btn btn-sm btn-outline-warning" href="{{ route('download.index') }}?file={{  $singleProposal[0]->file_proposal }}">Download Proposal</a>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="bg-light rounded h-100 p-4" style="border: 1px solid rgb(193, 193, 193); border-radius: 10px;">
                            <h6 class="mb-4">Latar Belakang</h6>
                            <p class="isi-latar-belakang-proposal text-muted">
                                {{ $singleProposal[0]->latar_belakang }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="bg-light rounded h-100 p-4" style="border: 1px solid rgb(193, 193, 193); border-radius: 10px;">
                            <h6 class="mb-4">Tujuan Kegiatan</h6>
                            <p class="isi-tujuan-kegiatan-proposal text-muted">
                                {{ $singleProposal[0]->tujuan_kegiatan }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Latar Belakang & Tujuan Kegiatan Starts Here -->

    <!-- Latar Belakang & Tujuan Kegiatan Ends Here -->



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
