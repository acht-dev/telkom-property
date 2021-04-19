@extends('layouts.admin')

@section('title', 'Admin - Security')

@section('main-title', 'Security')

@section('main-content')

<div class="container-fluid">
    <div class="row">
        <h5 class="card-title">Security</h5>
    </div>

    <div class="row">
        <button type="button" class="btn mr-2 mb-2 btn-primary ml-auto" data-togle="modal"
            data-target=".CreateDataSecurityModal">Large Tambah data</button>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered mx-auto datatable">
                <thead>
                    <tr class="text-center">
                        <th width="5%">No</th>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>Status Pernikahan</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Nama Client</th>
                        <th>Area</th>
                        <th>Kota</th>
                        <th>FM</th>
                        <th>BM</th>
                        <th>Lokasi Kerja</th>
                        <th>Posisi</th>
                        <th>Jabatan Baru</th>
                        <th>Skill</th>
                        <th>Fungsi</th>
                        <th>Mitra</th>
                        <th>Foto</th>
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
            ajax: '{{ route('get-data-security') }}',
            columns: [
                {data: null,
                    render: function ( data, type, row, meta ) { return incrementNum+1; }
                },
                {data: 'id', name: 'id'},
                {data: 'nama', name: 'nama'},
                { data: null,
                    render:function(data,type,row,meta){
                        if (row.status_pernikahan == '0') {
                            return 'Belum menikah'
                        } else if (row.status_pernikahan == '1') {
                            return 'Sudah menikah'
                        } else {
                            return 'Duda/Janda'
                        }
                    }
                },
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'tanggal_lahir', name: 'tanggal_masuk'},
                {data: null,
                    render:function(data,type,row,meta){
                        if (row.gender == '1') {
                            return 'Laki-laki'
                        } else {
                            return 'Perempuan'
                        }
                    }
                },
                {data: 'agama', name: 'tanggal_masuk'},
                {data: 'nama_client', name: 'tanggal_masuk'},
                {data: 'area', name: 'tanggal_masuk'},
                {data: 'kota', name: 'tanggal_masuk'},
                {data: 'FM', name: 'tanggal_masuk'},
                {data: 'BM', name: 'tanggal_masuk'},
                {data: 'lokasi_kerja', name: 'tanggal_masuk'},
                {data: 'posisi', name: 'tanggal_masuk'},
                {data: 'jabatan_baru', name: 'tanggal_masuk'},
                {data: 'skill', name: 'tanggal_masuk'},
                {data: 'fungsi', name: 'tanggal_masuk'},
                {data: 'mitra', name: 'tanggal_masuk'},
                {data: null,
                    render:function(data,type,row,meta){
                        if(row.foto == null) {
                        return '-'
                        } else {
                        '<img class="img-fluid rounded" src="{{ asset('/storage').'/'.'row.foto'}}" />';
                        }
                    }
                },
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });
    });
</script>
@endsection