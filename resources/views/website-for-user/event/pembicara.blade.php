@extends('website-for-user.partials-main.main')
@section('css')
<!-- Data Tables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">

<link rel="stylesheet" href="/assets-user/css/style-pembicara.css">
@endsection

@section('main')
<div class="container" style="margin-top: 150px;">
    <h5 style="margin-bottom: 30px;">SPEAKER</h5>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-12">
            <img src = "{{ $pembicara[0]->foto }}" alt= "foto" class ="pembicara-photo">
        </div>

        <div class="col-md-6 col-sm-12 col-12" style="margin-bottom: 30px">
            <p><b>Name : </b> <span class="nama_pembicara">{{ $pembicara[0]->nama }}</span></p>
            <p><b>Institution : </b><span class="institusi_pembicara">{{ $pembicara[0]->institusi}}  </span></p>
            <p><b>Position : </b> <span class="nama_pembicara">{{ $pembicara[0]->jabatan }}</span></p>
        </div>
    </div>

    <h5 style="margin-bottom: 30px; margin-top: 50px">SPEAKER'S HISTORY</h5>

    <div class="table-responsive" style="margin-bottom: 70px">
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
                    <th scope="col">Nama Event</th>
                    <th scope="col">Cara Pelaksanaan</th>
                    <th scope="col">Tempat</th>
                    <th scope="col">Tanggal Pelaksanaan</th>
                    <th scope="col">Jam</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th scope="col">Num.</th>
                    <th scope="col">Nama Event</th>
                    <th scope="col">Cara Pelaksanaan</th>
                    <th scope="col">Tempat</th>
                    <th scope="col">Tanggal Pelaksanaan</th>
                    <th scope="col">Jam</th>
                </tr>
            </tfoot>

            <tbody>
                @forelse ($pembicara as $e)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $e->nama_event }}</td>
                        <td>{{ $e->cara_pelaksanaan }}</td>
                        <td>{{ $e->tempat_pelaksanaan }}</td>
                        <td>{{ $e->tanggal_pelaksanaan }}</td>
                        <td>{{ date('H:i',strtotime($e->jam_mulai))}} - {{ date('H:i',strtotime($e->jam_selesai))}}</td>
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

    <div class="row">
        <div class="button">
            <div class="col-12 button-back-to-article" style="margin-bottom : 20px;">
                <a><button class="button-for-back" onclick="history.back()">Back</button></a>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src ="/assets-user/js/script.js"></script>
@endsection
