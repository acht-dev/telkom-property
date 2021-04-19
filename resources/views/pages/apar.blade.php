@extends('layouts.admin')

@section('title', 'Admin - Data APAR')

@section('main-title', 'Data APAR')

@section('main-content')

<div class="container-fluid">
    <div class="row">
        <h5 class="card-title">Data APAR</h5>
    </div>

    <div class="row">
        <button type="button" class="btn btn-primary ml-auto mb-3" id="btn-add" data-toggle="modal"
            data-target=".create-data-apar-modal">
            Tambah data</button>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered datatable">
                <thead>
                    <tr class="text-center">
                        <th width="5%">No</th>
                        <th>Lokasi Gedung</th>
                        <th>Area</th>
                        <th>Tabung No.</th>
                        <th>Kondisi Agent</th>
                        <th>Expired</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let incrementNum = 0
    $(document).ready(function() {
        // init datatable.
        var dataTable = $('.datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: true,
            pageLength: 5,
            "order": [[ 1, "asc" ]],
            
            columnDefs:[
                {   
                    "targets": [1],
                    "visible": false,
                    "searchable": false
                },
            ],
            ajax: '{{ route('get-apar-data') }}',
            columns: [
                {data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'lokasi_gedung', name: 'lokasi_gedung'},
                {data: 'area', name: 'area'},
                {data: 'no_tabung', name: 'no_tabung'},
                {data: 'kondisi', name: 'kondisi'},
                {data: 'expired', name: 'expired'},
                {data: 'Actions', name: 'Actions', orderable:false, serachable:false, sClass:'text-center'},
            ]
        });

        // START: Save New Daily Data
        $('#daily-form').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                data: formData,
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#daily-form').trigger("reset");
                    dataTable.draw();
                },
                error: function (data) {
                    $('#btn-submit').html('Error');
                }
            });
        });
        // END: Save New Daily Data
       
        // START: Edit Daily Data
        $('body').on('click', '#editDailyData', function () {
            var uuid = $(this).data('id');

            $.get("{{ route('data-apar.index') }}" +'/' + uuid +'/edit', function (data) {
                $('#modalTitle').html("Edit Data Harian");
                $('#btn-submit').val("Edit Data");
                $('.create-data-apar-modal').modal('show');
                $('#type').val('update');
                $('#uuid').val(data.uuid);
                $('#nama_petugas').val(data.nama_petugas);
                $('#area').val(data.area);
                $('#fm').val(data.fm);
            })
        });
        // START: Edit Daily Data

        // START: Delete Daily Data
        $('body').on('click', '#deleteDailyData', function (){
            var uuid = $(this).data("id");
            var result = confirm("Anda yakin ingin menghapus data ini !");
            if(result){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('data-apar.store') }}"+'/'+uuid,
                    success: function (data) {
                        dataTable.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }else{
                return false;
            }
        });
        // START: Delete Daily Data
    });
</script>
@endsection

@section('modal')
{{-- START: Add New Daily Data --}}
<div class="modal fade create-data-apar-modal w-100" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah data harian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="daily-form" class="daily-form" action="{{ route('data-apar.store') }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col">
                            <label for="nama_petugas">Nama Petugas <i class="text-danger">*</i></label>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="uuid" id="uuid">
                            <input type="hidden" name="type" id="type">
                            <input class="form-control" type="text" id="nama_petugas" name="nama_petugas" placeholder="Masukan nama petugas"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="area">Area <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="area" name="area" placeholder="Masukan area" required>
                        </div>
                        <div class="col">
                            <label for="fm">FM <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="fm" name="fm" placeholder="Masukan FM" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <input class="form-control btn btn-primary" type="submit" id="btn-submit" name="btn-submit"
                                value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- END: Add New Daily Data --}}
@endsection