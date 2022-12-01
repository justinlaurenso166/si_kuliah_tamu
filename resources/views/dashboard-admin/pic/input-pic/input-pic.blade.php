@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Form PIC Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Input PIC</h6>
                    <form action='{{ route('pic.store') }}' method='post'>
                        @csrf
                        <div class="row mb-3">
                            <label for="inputNamaPembicara" class="col-sm-2 col-form-label">Nama PIC</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNamaPembicara" name='nama_dosen'>
                                @error('nama_dosen')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputProdiPembicara" class="col-sm-2 col-form-label">Prodi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputProdiPembicara" name='prodi'>
                                @error('prodi')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-warning m-2 float-end">Submit Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form PIC Ends -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection
