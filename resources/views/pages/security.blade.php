@extends('layouts.admin')

@section('title', 'Admin - Security')

@section('main-title', 'Security')

@section('main-content')

<div class="container-fluid">
    <div class="row">
        <h5 class="card-title">Security</h5>
    </div>

    <div class="row">
        <button type="button" class="btn btn-primary ml-auto mb-3" id="btn-add" data-toggle="modal"
            data-target=".create-data-security-modal" data-backdrop="static" data-keyboard="false">
            Tambah data</button>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered datatable">
                <thead>
                    <tr class="text-center">
                        <th width="5%">No</th>
                        <th>Id</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Pensiun</th>
                        <th>Area</th>
                        <th>Lokasi Kerja</th>
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
            ajax: '{{ route('get-data-security') }}',
            columns: [
                {data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'id', name: 'id'},
                {data: null,
                    render:function(data,type,row,meta){
                        if(row.nama_file_foto == '') {
                            return '-'
                        } else {
                            return "<img class=\"img-fluid rounded\" src=\"{{ asset('/storage')}}" + "/" + row.nama_file_foto + "\" />";
                        }
                    }
                },
                {data: 'nama', name: 'nama'},
                {data: 'tanggal_masuk', name: 'tanggal_masuk'},
                {data: 'tanggal_lahir', name: 'tanggal_masuk'},
                {data: 'area', name: 'tanggal_masuk'},
                {data: 'lokasi_kerja', name: 'tanggal_masuk'},
                {data: 'Actions', name: 'Actions', orderable:false, serachable:false, sClass:'text-center'},
            ]
        });

        // START: Save New Security Data
        $('#security-form').submit(function (e) {
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
                    $('#security-form').trigger("reset");
                    $('.create-data-security-modal').modal('hide');
                    $('.modal-backdrop').remove();
                    dataTable.draw();
                },
                error: function (data) {
                    $('#btn-submit').html('Error');
                }
            });
        });
        // END: Save New Security Data
       
        // START: Edit Security Data
        $('body').on('click', '#editSecurityData', function () {
            var uuid = $(this).data('id');

            $.get("{{ route('security.index') }}" +'/' + uuid +'/edit', function (data) {
                $('#modalTitle').html("Edit Data Security");
                $('#btn-submit').val("Edit Data");
                $('.create-data-security-modal').modal('show');
                $('#type').val('update');
                $('#uuid').val(data.uuid);
                $('#nama').val(data.nama);
                $("input[name=status_kawin][value='" + data.status_pernikahan + "']").attr('checked', 'checked');
                $('#tanggal_masuk').val(data.tanggal_masuk);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $("#agama option[value='"+data.agama+"']").attr('selected', 'selected');
                $("input[name=gender][value='" + data.gender + "']").attr('checked', 'checked');
                $('#nama_client').val(data.nama_client);
                $('#area').val(data.area);
                $('#kota').val(data.kota);
                $('#bm').val(data.BM);
                $('#fm').val(data.FM);
                $('#lokasi_kerja').val(data.lokasi_kerja);
                $('#posisi').val(data.posisi);
                $('#jabatan_baru').val(data.jabatan_baru);
                $('#skill').val(data.skill);
                $('#fungsi').val(data.fungsi);
                $('#mitra').val(data.mitra);
            })
        });
        // START: Edit Security Data

        // START: Delete Security Data
        $('body').on('click', '#deleteSecurityData', function (){
            var uuid = $(this).data("id");
            var result = confirm("Anda yakin ingin menghapus data ini !");
            if(result){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('security.store') }}"+'/'+uuid,
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
        // START: Delete Security Data
    });
</script>
@endsection

@section('modal')
{{-- START: Add New Security Data --}}
<div class="modal fade create-data-security-modal w-100" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah data security</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="security-form" class="security-form" action="{{ route('security.store') }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col">
                            <label for="nama">Nama <i class="text-danger">*</i></label>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="uuid" id="uuid">
                            <input type="hidden" name="type" id="type">
                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Masukan nama"
                                required>
                        </div>
                        <div class="col">
                            <label for="status_kawin">Status Pernikahan <i class="text-danger">*</i></label>
                            <div class="input-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_kawin" id="status_kawin0"
                                        value="0" required>
                                    <label class="form-check-label text-muted" for="status_kawin0">Sudah Menikah</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_kawin" id="status_kawin1"
                                        value="1">
                                    <label class="form-check-label text-muted" for="status_kawin1">Belum Menikah</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_kawin" id="status_kawin2"
                                        value="2">
                                    <label class="form-check-label text-muted" for="status_kawin2">Duda/Janda</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="tanggal_masuk">Tanggal Masuk <i class="text-danger">*</i></label>
                            <input class="form-control" type="date" id="tanggal_masuk" name="tanggal_masuk" max="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col">
                            <label for="tanggal_lahir">Tanggal Lahir <i class="text-danger">*</i></label>
                            <input class="form-control" type="date" id="tanggal_lahir" name="tanggal_lahir" max="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label>Agama <i class="text-danger">*</i></label>
                            <select class="form-control custom-select" id="agama" name="agama" required>
                                <option value="">Pilih Agama</option>
                                <option value="islam">Islam</option>
                                <option value="kristen">Kristen</option>
                                <option value="katolik">Katolik</option>
                                <option value="hindu">Hindu</option>
                                <option value="budha">Budha</option>
                                <option value="konghucu">Konghucu</option>
                            </select>
                        </div>
                        <div class="col">
                            <label>Jenis Kelamin <i class="text-danger">*</i></label>

                            <div class="input-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="1"
                                        required>
                                    <label class="form-check-label text-muted" for="gender1">Laki -
                                        Laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                                    <label class="form-check-label text-muted" for="gender2">Perempuan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="nama_clien">Nama client <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="nama_client" name="nama_client"
                                placeholder="Masukan nama client" required>
                        </div>
                        <div class="col">
                            <label for="area">Area <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="area" name="area" placeholder="Masukan area"
                                required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="fm">Kota <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="kota" name="kota" placeholder="Masukan Kota"
                                required>
                        </div>
                        <div class="col">
                            <label for="bm">BM <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="bm" name="bm" placeholder="Masukan BM" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="fm">FM <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="fm" name="fm" placeholder="Masukan FM" required>

                        </div>
                        <div class="col">
                            <label for="lokasi_kerja">Lokasi kerja <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="lokasi_kerja" name="lokasi_kerja"
                                placeholder="Masukan lokasi kerja" required>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="posisi">Posisi <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="posisi" name="posisi"
                                placeholder="Masukan posisi" required>

                        </div>
                        <div class="col">
                            <label for="jabatan_baru">Jabatan baru <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="jabatan_baru" name="jabatan_baru"
                                placeholder="Masukan jabatan baru" required>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="skill">Skill <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="skill" name="skill"
                                placeholder="Masukan skill yang dimiliki" required>

                        </div>
                        <div class="col">
                            <label for="fungsi">Fungsi <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="fungsi" name="fungsi"
                                placeholder="Masukan fungsi">

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <label for="tanggal_lahir">Mitra <i class="text-danger">*</i></label>
                            <input class="form-control" type="text" id="mitra" name="mitra" placeholder="Masukan mitra"
                                required>
                        </div>
                        <div class="col-6">
                            <label for="tanggal_lahir">Gambar</label>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" id="gambar" name="gambar" accept="image/x-png,image/jpeg">
                                </div>
                            </div>
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
{{-- END: Add New Security Data --}}
@endsection