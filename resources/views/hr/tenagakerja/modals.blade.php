<!-- Tambah modal -->

<div id="tambahPegawaiModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" id="tambahForm" method="POST">
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="main-card mb-2 card">
                        <div class="card-body">
                            <h5 class="card-title">Data Pegawai</h5>
                            <div class="form-row">
                                <div class="col-md-7">
                                    <div class="position-relative form-group" id="tambah-name">
                                        <label for="exampleEmail" class="">Nama Lengkap Pegawai</label>
                                        <input name="name" id="exampleEmail" placeholder="Masukan Nama Pegawai" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="position-relative form-group" id="tambah-phone">
                                        <label for="exampleText" class="">No Telepon</label>
                                        <input name="phone" id="exampleText" class="form-control" type="text" placeholder="Format : 0812-3456-7890"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative form-group" id="tambah-address">
                                <label for="exampleText" class="">Lokasi</label>
                                <textarea rows="3" name="address" id="exampleText" class="form-control" placeholder="Masukan Lokasi Tempat Tinggal"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="col-md-5"> 
                                    <fieldset class="position-relative form-group">
                                        <label for="exampleText" class="">Penempatan</label>
                                        <div class="position-relative form-check">
                                            <input class="radio_penempatan_tambah" type="radio" id="staff" name="placement" value="Staff">
                                            <label for="html">Staff</label>
                                            <input class="radio_penempatan_tambah" type="radio" id="pegawai_lapangan" name="placement" value="Pegawai Lapangan">
                                            <label for="css">Pegawai Lapangan</label><br>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group jabatan_tambah" style="display: none;">
                                        <label for="exampleCustomSelect" class="">Jabatan</label>
                                        <select type="select" id="selectRoleTambah" name="role" class="custom-select">
                                            <option style='font-weight: bolder;' value=''>-- Pilih Jabatan --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="keterangan_tambah" style="display: none;">
                                    <div class="position-relative form-group jabatan_tambah" >
                                        <label for="exampleText" class="" >Keterangan (Opsional)</label>
                                        <input name="description" id="description" class="form-control" type="text"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-card mb-2 card account_tambah" style="display:none;">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Akun</h5>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group" id="tambah-name">
                                        <label for="exampleEmail" class="">Username</label>
                                        <input name="username" id="exampleEmail" placeholder="Masukan Username Pengguna" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group" id="tambah-phone">
                                        <label for="exampleText" class="">Email (Opsional)</label>
                                        <input name="email" id="exampleText" class="form-control" type="text" placeholder="Masukan Email Pengguna"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-tambah">Save Data</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit modal -->
<div id="editPegawaiModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Ubah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="" id="editForm" method="POST">
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="main-card mb-2 card">
                        <div class="card-body">
                            <h5 class="card-title">Data Pegawai</h5>
                            <div class="form-row">
                                <div class="col-md-7">
                                    <div class="position-relative form-group" id="tambah-name">
                                        <label for="exampleEmail" class="">Nama Lengkap Pegawai</label>
                                        <input name="name" id="exampleEmail" placeholder="Masukan Nama Pegawai" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="position-relative form-group" id="tambah-phone">
                                        <label for="exampleText" class="">No Telepon</label>
                                        <input name="phone" id="exampleText" class="form-control" type="text" placeholder="Format : 0812-3456-7890"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative form-group" id="tambah-address">
                                <label for="exampleText" class="">Alamat</label>
                                <textarea rows="3" name="address" id="exampleText" class="form-control" placeholder="Masukan Alamat Tempat Tinggal"></textarea>
                            </div>
                            <div class="form-row for-staff">
                                <div class="col-md-5">
                                    <div class="position-relative form-group" id="text-penempatan">
                                        <label for="exampleEmail" class="">Penempatan</label>
                                        <input disabled style="background-color:#fff; font-size:1.1em; border:none; border-width:0px;" name="field_penempatan_edit" id="exampleEmail" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="position-relative form-group" id="text-jabatan">
                                        <label for="exampleText" class="">Jabatan</label>
                                        <input disabled style="background-color:#fff; font-size:1.1em; border:none; border-width:0px;" name="field_jabatan_edit" id="exampleText" class="form-control" type="text"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row for-lapangan">
                                <div class="col-md-5"> 
                                    <fieldset class="position-relative form-group">
                                        <label for="exampleText" class="">Penempatan</label>
                                        <div class="position-relative form-check">
                                            <input class="radio_penempatan_edit" type="radio" id="staff_edit" name="placement_edit" value="Staff">
                                            <label for="html">Staff</label>
                                            <input class="radio_penempatan_edit" type="radio" id="pegawai_lapangan_edit" name="placement_edit" value="Pegawai Lapangan">
                                            <label for="css">Pegawai Lapangan</label><br>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group jabatan">
                                        <label for="exampleCustomSelect" class="">Jabatan</label>
                                        <select type="select" id="selectRoleEdit" name="role" class="custom-select">
                                            <option style='font-weight: bolder;' value=''>-- Pilih Jabatan --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" id="keterangan_edit" style="display: none;">
                                    <div class="position-relative form-group jabatan" >
                                        <label for="exampleText" class="" >Keterangan (Opsional)</label>
                                        <input name="description" id="description_edit" class="form-control" type="text"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-card mb-2 card account_edit" style="display:none;">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Akun</h5>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group" id="edit-name">
                                        <label for="exampleEmail" class="">Username</label>
                                        <input name="username" id="exampleEmail" placeholder="Masukan Username Pengguna" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group" id="edit-phone">
                                        <label for="exampleText" class="">Email (Opsional)</label>
                                        <input name="email" id="exampleText" class="form-control" type="text" placeholder="Masukan Email Pengguna"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-edit">Save Data</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Modal Hapus -->
<div class="modal fade" id="hapusPegawaiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data Tenaga Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Apakah anda yakin akan menghapus data ini?</p>
            </div>
            <div class="modal-footer">
            <form id="hapusPegawaiForm" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn-hapus" >Save changes</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    $("#btn-tambah-tenaga").on('click', function() {
        $('#tambahForm')[0].reset();
        $('.jabatan_tambah').hide();
        $('.account_tambah').hide();
        $('#keterangan_tambah').hide();
        // console.log(url());
    })

    $('.datatable').DataTable({
        
        processing: true,
        serverSide: true,
        ajax:{
            url:"/tenagakerja/",
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
            },
        }
        ,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'address', name: 'address'},
            {data: 'placement', name: 'placement'},
            {data: 'position', name: 'position'},
            {data: 'description', name: 'description'},
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },
        
    });

    $('input[class="radio_penempatan_tambah"]').on('change', function () {
        const pilihan = $(this).val();
        $('.account_tambah').hide();
        $('#selectRoleTambah option').remove();
        $('.jabatan_tambah').show();
        if (pilihan == "Pegawai Lapangan") {
            console.log(pilihan);
            $('#keterangan_tambah').show();
            $('#selectRoleTambah').append(
                "<option style='font-weight: bolder;' value=''>-- Pilih Jabatan --</option>" +
                "<option value='Tukang'>Tukang</option>" +
                "<option value='Laden'>Laden</option>"
            );
        }else if (pilihan == "Staff") {
            $('#keterangan_tambah').hide();
            $('#selectRoleTambah').append(
                "<option style='font-weight: bolder;' value=''>-- Pilih Jabatan --</option>" +
                "<option value='HR'>HR</option>" +
                "<option value='Logistik'>Logistik</option>" +
                "<option value='Ketua Lapangan'>Ketua Lapangan</option>"
            );   
        }
    })
    $('input[class="radio_penempatan_edit"]').on('change', function () {
        const pilihan = $(this).val();
        $('.account_edit').hide();
        $('#selectRoleEdit option').remove();
        $('.jabatan_edit').show();
        if (pilihan == "Pegawai Lapangan") {
            console.log(pilihan);
            $('#keterangan_edit').show();
            $('#selectRoleEdit').append(
                "<option style='font-weight: bolder;' value=''>-- Pilih Jabatan --</option>" +
                "<option value='Tukang'>Tukang</option>" +
                "<option value='Laden'>Laden</option>"
            );
        }else if (pilihan == "Staff") {
            $('#keterangan_edit').hide();
            $('#selectRoleEdit').append(
                "<option style='font-weight: bolder;' value=''>-- Pilih Jabatan --</option>" +
                "<option value='HR'>HR</option>" +
                "<option value='Logistik'>Logistik</option>" +
                "<option value='Ketua Lapangan'>Ketua Lapangan</option>"
            );   
        }
    })

    $('select[id="selectRoleTambah"]').on('change', function (){
        console.log($(this).val());
        if ($(this).val() == "Ketua Lapangan") {
            $('.account_tambah').show();
        }else{
            $('.account_tambah').hide();
        }
    })  
    $('select[id="selectRoleEdit"]').on('change', function (){
        console.log($(this).val());
        if ($(this).val() == "Ketua Lapangan") {
            $('.account_edit').show();
        }else{
            $('.account_edit').hide();
        }
    })  

    $('#btn-tambah').click(function() {
        const pegawai = $('#tambahForm');
        const formData = pegawai.serialize();
        console.log(formData.description);
        const jenis = 'tambah';
        const url = "/tenagakerja";
        const type = "POST";
        setValidate(formData, url, jenis, type)
    })

    // show modal form edit 
    $('.table tbody').on('click', '.btnEdit', function() {
        $('#editForm')[0].reset();
        $('.jabatan_edit').hide();
        $('.account_edit').hide();
        $('#keterangan_edit').hide();
        $('.for-lapangan').hide();
        $('.for-staff').hide();
        let radio = $(".radio_penempatan_edit").val();
        console.log(radio);
        $('#selectRoleEdit option').remove();
        // // data = {!! json_encode($data[''])}
        // // resetAlert('edit');
        // const currow = $(this).closest('tr');
        // // console.log(currow);
        // const col1 = currow.find('td:eq(1)').text();
        // const col2 = currow.find('td:eq(2)').text();
        // const col3 = currow.find('td:eq(3)').text();
        // // const col4 = currow.find('td:eq(4)').text();
        const id = $(this).data('id');
        let url = '/tenagakerja/show/:id';
        url = url.replace(':id', id);
        const type = "GET";

        $.ajax({
            id:id,
            url: url,
            type : type,
            success: function(res) {
                console.log(res); 
                $('input[name="name"]').val(res.name);
                $('input[name="phone"]').val(res.phone);
                // $('input[name="username"]').val(res.username);
                $('textarea[name="address"]').val(res.address);
                $('input[name="field_penempatan_edit"]').val(res.placement);
                $('input[name="field_jabatan_edit"]').val(res.position);
                // if (res.placement == "Staff" || res.placement == "Pegawai Lapangan") {
                //     $(`input[name="placement_edit"][value="${res.placement}"`).prop('checked', true); 
                //     if (res.placement == "Pegawai Lapangan") {
                //         $('#keterangan_edit').show();
                //         $('#description_edit').val(res.description);
                //         $('#selectRoleEdit').append(
                //             "<option style='font-weight: bolder;' value=''>-- Pilih Jabatan --</option>" +
                //             "<option value='Tukang'>Tukang</option>" +
                //             "<option value='Laden'>Laden</option>"
                //             );
                //         $('select[name="role"]').val(res.position);
                //     } else {
                //         $('#selectRoleEdit').append(
                //             "<option style='font-weight: bolder;' value=''>-- Pilih Jabatan --</option>" +
                //             "<option value='HR'>HR</option>" +
                //             "<option value='Logistik'>Logistik</option>" +
                //             "<option value='Ketua Lapangan'>Ketua Lapangan</option>"
                //         );   
                //         $('select[name="role"]').val(res.position);
                //         if (res.position == "Ketua Lapangan") {
                //             $('.account_edit').show();
                //             $("input[name='username']").val("username");
                //             $("input[name='email']").val("email");
                //         }
                //     }
                // }

                if (res.placement == "Staff") {
                    $('.for-staff').show();
                }else{
                    $('.for-lapangan').show();
                    $('#keterangan_edit').show();
                    $('#description_edit').val(res.description);
                    $(`input[name="placement_edit"][value="${res.placement}"`).prop('checked', true); 
                    $('#selectRoleEdit').append(
                        "<option style='font-weight: bolder;' value=''>-- Pilih Jabatan --</option>" +
                        "<option value='Tukang'>Tukang</option>" +
                        "<option value='Laden'>Laden</option>"
                        );
                    $('select[name="role"]').val(res.position);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
            }

        })

        // console.log(id);
        
        // $('input[name="name"]').val(col1);
        // $('input[name="unit"]').val(col3);
        $('#editPegawaiModal').modal();
        
        let urlPost = '/tenagakerja/:id';
        urlPost = urlPost.replace(':id', id);
        $('#editForm').attr('action', urlPost);
        // console.log($('#editForm'));
        
    });

    $('#btn-edit').click(function() {
        event.preventDefault();
        const edit = $('#editForm');
        const formData = edit.serialize();
        const url = $('#editForm').attr('action');
        const jenis = 'edit';
        const type = "PUT";
        // console.log(formData);
        setValidate(formData, url, jenis, type);
    })

    $('.table tbody').on('click', '.btnHapus', function() {
        const id = $(this).data('id');
        $('#btn-hapus').attr('data-id', id);
        $('#hapusPegawaiModal').modal();
    })

    $('#btn-hapus').click(function() {
        event.preventDefault();
        const dataId = $(this).data('id');
        var url = '/tenagakerja/:id';
        url = url.replace(":id", dataId);
        $('#hapusPegawaiModal').attr('action', url);
        $.ajax({
            data : dataId,
            url : url,
            type: "DELETE",
            success: function(data) {
                setalert(data.title, data.text, data.icon);
                setTimeout(function(){
                    window.location.reload();
                }, 2000);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
            }
        })
    })

    function setValidate(formData, url, jenis, type) {
        $.ajax({
            data : formData,
            url: url,
            type : type,
            success: function(data) {
                console.log(data);
                $(`#${jenis}PegawaiModal`).modal('hide');
                // location.reload();
                setalert(data.title, data.text, data.icon);
                setTimeout(function(){
                    window.location.reload();
                }, 2000);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
            }
        })
    }

    function setalert(title, text, icon) {
        swal({
            title: title,
            text: text,
            icon: icon,
            button : false,
        });
    }
</script>
