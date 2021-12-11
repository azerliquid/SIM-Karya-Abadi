<!-- Tambah modal -->

<div id="tambahBarangModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">From Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="tambahForm">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="position-relative form-group" id="tambah-name">
                            <label for="exampleEmail11" class="">Nama Barang</label>
                            <input name="name"  placeholder="Masukan nama barang" type="text" class="form-control"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group" id="tambah-unit">
                            <label for="examplePassword11" class="">Satuan</label>
                            <input name="unit" placeholder="Masukan satuan barang" type="text"class="form-control"></div>
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

<div id="editBarangModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">From Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="editForm" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}
                    <div class="form-row">
                        <div class="col-md-8">
                            <div class="position-relative form-group" id="edit-name">
                            <label for="exampleEmail11" class="">Nama Barang</label>
                            <input name="name"  placeholder="Masukan nama barang" type="text" class="form-control"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative form-group" id="edit-unit">
                            <label for="examplePassword11" class="">Satuan</label>
                            <input name="unit" placeholder="Masukan satuan barang" type="text"class="form-control"></div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-update">Save Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Show Modal Hapus -->
<div class="modal fade" id="hapusBarangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form id="hapusBarangForm" method="POST">
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

    $("#btn-tambah-barang").on('click', function() {
        resetAlert('tambah');
        $('#tambahForm')[0].reset();
    })
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url:"/barang/",
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
            {data: 'stock_now', name: 'stock_now'},
            {data: 'unit', name: 'unit'},
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },
        
    });

    // action tambah data barang
    $('#btn-tambah').click(function() {
        event.preventDefault();
        var tambah = $('#tambahForm');
        var formData = tambah.serialize();
        const jenis = 'tambah';
        const url = "{{route('barang.store')}}"
        const type = "POST"
        console.log(formData);
        setValidate(formData, jenis, url, type);        
    })

    // show modal form edit 
    $('.table tbody').on('click', '.btnEdit', function() {
        // data = {!! json_encode($data[''])}
        resetAlert('edit');
        const currow = $(this).closest('tr');
        // console.log(currow);
        const col1 = currow.find('td:eq(1)').text();
        const col3 = currow.find('td:eq(3)').text();
        const id = $(this).data('id');
        console.log(id);
        
        $('input[name="name"]').val(col1);
        $('input[name="unit"]').val(col3);
        
        var url = '{{ route("barang.update", ":id")}}';
        url = url.replace(':id', id);
        $('#editForm').attr('action', url);
        $('#editBarangModal').modal();
        console.log($('#editForm'));
        
    });

    // action update data barang
    $('body').on('click', '#btn-update', function() {
        event.preventDefault(); 
        var edit = $('#editForm');
        var formData = edit.serialize();
        var url = $('#editForm').attr('action');
        const jenis = "edit";
        const type ="PUT"
        console.log(url);
        setValidate(formData, jenis, url, type);
    })

    $('body').on('click', '.btnHapus', function() {
        // event.preventDefault(); 
        var id = $(this).data('id');
        $('#btn-hapus').attr('data-id', id);
        // console.log(url);
        $('#hapusBarangModal').modal();
    })

    $('#btn-hapus').on('click', function() {
        event.preventDefault();
        var dataId = $(this).data('id');
        var url = '{{ route("barang.destroy", ":id") }}';
        url = url.replace(':id', dataId);
        $('#hapusBarangForm').attr('action' , url);
        console.log(dataId);
        $.ajax({
            id:dataId,
            url:url,
            type:'DELETE',
            success:function(data) {
                console.log(data);
                if (data.errors) {
                    console.log(data.errors);
                }else{
                    console.log(data.success);
                    location.reload();
                }
            }
        });
    })

    function setValidate(formData, jenis, url, type) {
        $( `#${jenis}-name small` ).remove();
        $( `#${jenis}-unit small` ).remove();
        $.ajax({
            data: formData,
            url: url,
            type: type,
            success: function(data) {
                // console.log(data);
                if (data.errors) {
                console.log(data.errors);
                    if (data.errors.name) {
                        $(`#${jenis}-name`).append(`<small style="color:red">	&nbsp; ${data.errors.name[0]}</small>`);
                    }
                    if (data.errors.unit) {
                        $(`#${jenis}-unit`).append(`<small style="color:red">	&nbsp; ${data.errors.unit[0]}</small>`);
                    }
                }else{
                    swal({
                        title: "Sukses!",
                        text: `Data berhasil di ${jenis} !`,
                        icon: "success",
                        button : false,
                    });
                    setTimeout(function(){
                    window.location.reload();
                    }, 2000);
                }
                // $('#tambahBarangModal').modal('toggle');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
            }
        })
    }

    function resetAlert(jenis) {
        $( `#${jenis}-name small` ).remove();
        $( `#${jenis}-unit small` ).remove();
    }
</script>