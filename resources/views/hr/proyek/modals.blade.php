<!-- Tambah modal -->

<div id="tambahProjectModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Proyek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="tambahForm" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="position-relative form-group" id="tambah-name_project">
                            <label for="exampleEmail" class="">Nama Proyek</label>
                            <input name="name_project" id="exampleEmail" placeholder="Masukan Nama Proyek" type="text" class="form-control">
                        </div>
                        <div class="position-relative form-group" id="tambah-location">
                            <label for="exampleText" class="">Lokasi</label>
                            <textarea name="location" id="exampleText" class="form-control" placeholder="Masukan Lokasi Proyek"></textarea>
                        </div>
                        <div class="position-relative form-group" id="tambah-ketua">
                            <label for="exampleText" class="">Ketua Lapangan</label>
                            <select type="select" id="selectKetuaTambah" name="ketua" class="custom-select">
                                <option style='font-weight: bolder;' value=''>-- Pilih Ketua Lapangan --</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-tambah">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit modal -->

<div id="editProjectModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Edit Data Proyek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="editForm" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="position-relative form-group" id="edit-name_project">
                            <label for="exampleEmail" class="">Nama Proyek</label>
                            <input name="name_project" id="exampleEmail" placeholder="Masukan Nama Proyek" type="text" class="form-control">
                        </div>
                        <div class="position-relative form-group" id="edit-location">
                            <label for="exampleText" class="">Lokasi</label>
                            <textarea name="location" id="exampleText" class="form-control" placeholder="Masukan Lokasi Proyek"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btn-edit">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Show Modal Hapus -->
<div class="modal fade" id="hapusProyekModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Apakah anda yakin akan menghapus data ini?</p>
            </div>
            <div class="modal-footer">
            <form id="hapusProyekForm" method="POST">
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
    
    $("#btn-tambah-project").on('click', function() {
        resetAlert('tambah');
        console.log("oke");
        // $('#tambahForm')[0].reset();
        $.ajax({
            // data : dataId,
            // processing: true,
            // serverSide: true,
            
            dataType: "json",
            url : '{{ route("proyek.create")}}',
            type: "GET",
            success: function(res) {
                console.log(res);
                for (let index = 0; index < res.length; index++) {
                    let opt = `<option value='${res[index].id}'>${res[index].name}</option>`
                    $('#selectKetuaTambah').append(opt);
                }
                
                // let opt = ;
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
                console.log(err.Message);
            }
        })
    })

    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url:"/proyek/",
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
            },
        }
        ,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name_project', name: 'name_project'},
            {data: 'head_project.name', name: 'head_project.name'},
            {data: 'location', name: 'location'},
            {data: 'status', name: 'status', orderable: false, searchable: false, },
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },
        
    });

    $('#btn-tambah').click(function() {
        event.preventDefault();
        const tambah = $('#tambahForm');
        const formData = tambah.serialize();
        console.log(formData);
        const jenis = 'tambah';
        const url = "{{route('proyek.store')}}";
        const type = "POST";
        setValidate(formData, url, jenis, type)
    })

    $('.table tbody').on('click', '.btnEdit', function(params) {
        resetAlert('edit');
        var currow = $(this).closest('tr');

        var col1 = currow.find('td:eq(1)').text();
        var col2 = currow.find('td:eq(3)').text();
        var id = $(this).data('id');

        $('input[name="name_project"]').val(col1);
        $('textarea[name="location"]').val(col2);
        $('#editProjectModal').modal();

        var url = '{{ route("proyek.update", ":id") }}'
        url = url.replace(':id', id);
        
        $('#editForm').attr('action', url);
    })
    
    $('#btn-edit').click(function() {
        event.preventDefault();
        const edit = $('#editForm');
        const formData = edit.serialize();
        const url = $('#editForm').attr('action');
        const jenis = 'edit';
        const type = "PUT";

        setValidate(formData, url, jenis, type);
    })

    $('body').on('click', '.btnHapus',function() {
        const id = $(this).data('id');
        $('#btn-hapus').attr('data-id', id);
        $('#hapusProyekModal').modal();
    })

    $('#btn-hapus').click(function() {
        event.preventDefault();
        const dataId = $(this).data('id');
        var url = '{{ route("proyek.destroy", ":id") }}';
        url = url.replace(":id", dataId);
        $('#hapusProyekModal').attr('action', url);
        $.ajax({
            data : dataId,
            url : url,
            type: "DELETE",
            success: function(res) {
                console.log(res);

                setalert(res.title, res.text, res.icon);
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
        $(`#${jenis}-name_project small`).remove();
        $(`#${jenis}-location small`).remove();
        $.ajax({
            data: formData,
            url: url,
            type: type,
            success:function(data) {
                console.log(data);
                if (data.errors) {
                    if (data.errors.name_project) {
                        $(`#${jenis}-name_project`).append(`<small style="color:red">	&nbsp; ${data.errors.name_project[0]}</small>`)
                    }
                    if (data.errors.location) {
                        $(`#${jenis}-location`).append(`<small style="color:red">	&nbsp; ${data.errors.location[0]}</small>`)
                    }  
                }
                else {
                    const alert = data;
                    console.log(alert);
                    setalert(alert.title, alert.text, alert.icon);
                    setTimeout(function(){
                    window.location.reload();
                    }, 2000);
                    // table.ajax.reload();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
            }
        })
    }

    function resetAlert(jenis) {
        $( `#${jenis}-name_project small` ).remove();
        $( `#${jenis}-location small` ).remove();
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