<!-- Tambah modal -->

<div id="tambahBarangModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="tambahForm">
                    {{ csrf_field() }}
                    
                <div class="col-md-12">
                    <div class="main-card mb-2 card">
                        <div class="card-body">
                            <h5 class="card-title">Data Barang Masuk</h5>
                            <div class="inputItem">
                                <div class="form-row">
                                    <div class="col-md-4"> 
                                        <fieldset class="position-relative form-group">
                                            <label for="exampleText" class="">Tertuju</label>
                                            <div class="position-relative form-check">
                                                <input class="radio_tertuju" type="radio" id="radio_kantor" name="tertuju" value="Kantor">
                                                <label for="html">Kantor</label>
                                                <input class="radio_tertuju" type="radio" id="radio_proyek" name="tertuju" value="Proyek">
                                                <label for="css">Proyek</label><br>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group tujuan" style="display:none;">
                                            <label for="exampleCustomSelect" class="">Tujuan Proyek</label>
                                            <select type="select" id="selectTujuan" name="lokasi" class="custom-select">
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-8">
                                        <div class="position-relative form-group" id="tambah-barang-masuk">
                                            <label for="name-barang" class="">Nama Barang Masuk</label>
                                            <select type="select" id="selectBarang-1" name="barang-1" class="custom-select">
                                                <option style='font-weight: bolder;' value=''>-- Pilih Barang --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group" id="tambah-stock_in">
                                            <label for="exampleText" class="">Stok Masuk</label>
                                            <input name="qty-1" id="exampleText" class="form-control" type="number"></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="mx-auto">
                                    <input type="text" name="total_item" id="totalItem" value="1" style="display:none;">
                                    <button class="mb-2 mr-2 btn-transition btn btn-outline-primary" onclick="addItem()">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-plus-square fa-w-20"></i>
                                        </span>
                                        Tambah Item
                                    </button>
                                </div>
                            </div>
                            
                            <div class="position-relative form-group" id="tambah-address">
                                <label for="exampleText" class="">Keterangan</label>
                                <textarea name="keterangan" rows="3" name="description" id="exampleText" class="form-control" placeholder="Masukan Keterangan"></textarea>
                            </div>
                        </div>
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

    let barang;
    let index_select = 2;

    $("#btn-tambah-barang").on('click', function() {
        $('#tambahForm')[0].reset();
        $('.tujuan').hide();
        $('.children').remove();
        $('#selectTujuan').empty().append(`<option style='font-weight: bolder;' selected="selected" value="0">-- Pilih Lokasi --</option>`);
        let proyek;
        $.ajax({
            dataType: "json",
            url : '/baranginout/create',
            type: "GET",
            success: function(res) {
                console.log(res);
                barang = res.barang;
                proyek = res.proyek;
                for (let pro = 0; pro < proyek.length; pro++) {
                    let opt = `<option value='${proyek[pro].id}'>${proyek[pro].name_project}</option>`;
                    $(`#selectTujuan`).append(opt);
                }
                setSelectOpt(1, barang);
                
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

    function addItem() {
        event.preventDefault();
        console.log('oke');
        $('.inputItem').append(
            `<div class="form-row children">
                <div class="col-md-8">
                    <div class="position-relative form-group" id="tambah-barang-masuk">
                        <label for="name-barang" class="">Nama Barang Masuk</label>
                        <select type="select" id="selectBarang-${index_select}" name="barang-${index_select}" class="custom-select">
                            <option style='font-weight: bolder;' value=''>-- Pilih Barang --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative form-group" id="tambah-stock_in">
                        <label for="exampleText" class="">Stok Masuk</label>
                        <input name="qty-${index_select}" id="exampleText" class="form-control" type="number"></input>
                    </div>
                </div>
            </div>`
        );
        setSelectOpt(index_select, barang);
        $('#totalItem').val(index_select);
        console.log(index_select);
        index_select = index_select + 1;
        // console.log("val : "+ $('#totalItem').val());
    }

    function setSelectOpt(index, brg) {
        for (let i = 0; i < brg.length; i++) {
            let opt = `<option value='${brg[i].id}'>${brg[i].name} (${brg[i].unit})</option>`;
            $(`#selectBarang-${index}`).append(opt);
        }
        // $().select2();
        $(`#selectBarang-${index}`).each((_i, e) => {
            var $e = $(e);
            $e.select2({
                dropdownParent: $e.parent()
            });
        })
        
        // $(`#selectBarang-${index}`).addClass("custom-select");
        
    }


    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url:"/baranginout/",
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
            },
        }
        ,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'date', name: 'date'},
            {data: 'type', name: 'type'},
            {data: 'barang', name: 'barang'},
            {data: 'qty', name: 'qty'},
            {data: 'destination', name: 'destination'},
            {data: 'proyek', name: 'proyek'},
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },
        
    });
    $('.radio_tertuju').on('change', function () {
        console.log($(this).val());
        if ($(this).val() == "Proyek") {
            $('.tujuan').show();
        }
        if ($(this).val() == "Kantor") {
            $('.tujuan').hide();
        }
    })

    $('#btn-tambah').on('click', function() {
        var url = '/baranginout/store';
        const formData = $('#tambahForm').serialize();
        let totalItem = $('#totalItem').val();
        let tertuju = $("input[name='tertuju']:checked").val();
        let lokasi = $('#selectTujuan').val();
        let keterangan = $("textarea[name='keterangan']").val();
        // console.log(keterangan);
        let data = {
            tertuju : tertuju,
            lokasi : lokasi,
            keterangan : keterangan,
            type: "Masuk"
        }
        let dataItem = [];
        let itemloop = 1;

        for (let i = 0; i < totalItem; i++) {
            let id_barang = $(`select[name='barang-${itemloop}']`).val();
            let qty = $(`input[name='qty-${itemloop}']`).val();
            dataItem.push({
                id_barang,
                qty
            })

            itemloop += 1;
        }

        data.listItem = dataItem;
        console.log(data);

        $.ajax({
            url: url,
            method: 'POST',
            data: {
            data:data,
            },
            success: function(res){
                console.log(res);
            },
            error:function(error){
                console.log(error.responseText);
            }
        });

        // console.log(dataItem);
        // console.log($('barang-2').val());
    });
</script>