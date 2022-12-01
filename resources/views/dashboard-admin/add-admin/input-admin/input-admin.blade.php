@extends('dashboard-admin.partials-main.main')

@section('main')
    <!-- Form Register Admin Starts -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Input Data Admin</h6>
                    <form action="{{ route('registeradmin.store') }}" method='POST'>
                        {{-- @method('DELETE') --}}
                        {{-- enctype="multipart/form-data" --}}
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmailAdmin" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmailAdmin" name="email">
                                @error('email')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputUsernameAdmin" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputUsernameAdmin" name="username">
                                @error('username')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputPasswordAdmin" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputPasswordAdmin" name="password">
                                @error('password')
                                    <p class="text-danger"><i>{{ $message }}</i></p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-warning m-2 float-end">Register Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Register Admin Ends -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endsection

