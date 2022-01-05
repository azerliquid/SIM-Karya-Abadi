<!-- Masuk modal -->

<div id="tambahBarangModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Input Barang Masuk</h5>
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
                                            <select type="select" id="selectTujuanIn" name="lokasi" class="custom-select">
                                                
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

<!-- Keluar modal -->

<div id="keluarBarangModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Form Input Barang Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="keluarForm">
                    {{ csrf_field() }}
                    
                <div class="col-md-12">
                    <div class="main-card mb-2 card">
                        <div class="card-body">
                            <h5 class="card-title">Data Barang Keluar</h5>
                            <div class="inputItemOut">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="position-relative form-group tujuan">
                                            <label for="exampleCustomSelect" class="">Tujuan Proyek</label>
                                            <select type="select" id="selectTujuanOut" name="lokasiOut" class="custom-select">
                                                <option style='font-weight: bolder;' value=''>-- Pilih Tujuan --</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group" id="tambah-barang-keluar">
                                            <label for="name-barang" class="">Nama Barang Keluar</label>
                                            <select type="select" id="selectBarangOut-1" name="barangOut-1" class="custom-select">
                                                <option style='font-weight: bolder;' value=''>-- Pilih Barang --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group" id="tambah-stock_out">
                                            <label for="exampleText" class="">Qty</label>
                                            <input name="qtyOut-1" id="exampleText" class="form-control" type="number"></input>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group" id="tambah-stock_out">
                                            <label for="exampleText" class="">Harga Retail</label>
                                            <input name="priceOut-1" id="exampleText" class="form-control" type="number"></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="mx-auto">
                                    <input type="text" name="total_item_out" id="totalItemOut" value="1" style="display:none;">
                                    <button class="mb-2 mr-2 btn-transition btn btn-outline-primary" onclick="addItemOut()">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fa fa-plus-square fa-w-20"></i>
                                        </span>
                                        Tambah Item
                                    </button>
                                </div>
                            </div>
                            
                            <div class="position-relative form-group" id="tambah-address">
                                <label for="exampleText" class="">Keterangan</label>
                                <textarea name="keteranganOut" rows="3" name="description" id="exampleText" class="form-control" placeholder="Masukan Keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-keluar">Save Data</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    var startDate = {!! json_encode($start) !!};
    var endDate = {!! json_encode($end) !!};

    var newStartDate = moment(startDate).format('DD-MM-YYYY');
    var newEndDate = moment(endDate).format('DD-MM-YYYY');

    // setDate

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $('input[name="daterangeBarangInOut"]').daterangepicker({
            "showDropdowns": true,
            ranges: {
                'Hari Ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "alwaysShowCalendars": true,
            "startDate": newStartDate,
            "endDate": newEndDate,    
            "drops": "auto",
            // "locale" : 'DD-MM-YYYY'
            locale: {
                format: 'DD-MM-YYYY',
                separator : ' s/d '
            }
        }, function(start, end, label) {
            newStartDate = start.format('YYYY-MM-DD');
            // console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            console.log(newStartDate);
        });
    });

    let barang;
    let index_select = 2;
    let index_select_out = 2;


    $("#btn-tambah-barang").on('click', function() {
        // console.log($('input[name="daterangeBarangInOut"]').val());
        $(`#selectBarang-1`).empty().append(`<option style='font-weight: bolder;' value=''>-- Pilih Barang --</option>`);
        $('#tambahForm')[0].reset();
        $('.tujuan').hide();
        $('.children').remove();
        $('#selectTujuanIn').empty().append(`<option style='font-weight: bolder;' selected="selected" value="0">-- Pilih Lokasi --</option>`);
        getDataOpt('In');
    });

    $("#btn-keluar-barang").on('click', function() {
        console.log('okeokeoke');
        // console.log($('input[name="daterangeBarangInOut"]').val());
        // $(`#selectBarang-1`).empty().append(`<option style='font-weight: bolder;' value=''>-- Pilih Barang --</option>`);
        // $('#tambahForm')[0].reset();
        // $('.tujuan').hide();
        // $('.children').remove();
        // $('#selectTujuan').empty().append(`<option style='font-weight: bolder;' selected="selected" value="0">-- Pilih Lokasi --</option>`);
        getDataOpt('Out');
    });

    function getDataOpt(type) {
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
                    $(`#selectTujuan${type}`).append(opt);
                }
                if (type == 'In') {
                    setSelectOpt(1, barang);
                }
                if (type == 'Out') {
                    setSelectOptOut(1, barang);
                    
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
    }

    function addItem() {
        event.preventDefault();
        console.log('oke');
        $(`.inputItem`).append(
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

    function addItemOut() {
        event.preventDefault();
        console.log('oke');
        $(`.inputItemOut`).append(
            `<div class="form-row children">
                <div class="col-md-6">
                    <div class="position-relative form-group" id="tambah-barang-keluar">
                        <label for="name-barang" class="">Nama Barang Keluar</label>
                        <select type="select" id="selectBarangOut-${index_select_out}" name="barangOut-${index_select_out}" class="custom-select">
                            <option style='font-weight: bolder;' value=''>-- Pilih Barang --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative form-group" id="tambah-stock_out">
                        <label for="exampleText" class="">Qty</label>
                        <input name="qtyOut-${index_select_out}" id="exampleText" class="form-control" type="number"></input>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative form-group" id="tambah-stock_out">
                        <label for="exampleText" class="">Harga Retail</label>
                        <input name="priceOut-${index_select_out}" id="exampleText" class="form-control" type="number"></input>
                    </div>
                </div>
            </div>`
        );
        setSelectOptOut(index_select_out, barang);
        $('#totalItemOut').val(index_select_out);
        // console.log($('#totalItemOut').val());
        index_select_out = index_select_out + 1;
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

    function setSelectOptOut(index, brg) {
        for (let i = 0; i < brg.length; i++) {
            let opt = `<option value='${brg[i].id}'>${brg[i].name} (${brg[i].unit})</option>`;
            $(`#selectBarangOut-${index}`).append(opt);
        }
        // $().select2();
        $(`#selectBarangOut-${index}`).each((_i, e) => {
            var $e = $(e);
            $e.select2({
                dropdownParent: $e.parent()
            });
        })
        
        // $(`#selectBarang-${index}`).addClass("custom-select");
        
    }

    var myDt = $('.datatable').DataTable({
        
        processing: true,
        scrollY:        400,
        deferRender:    true,
        scroller:       true,
        ajax:{
            url:'/baranginout/All/'+newStartDate+'/'+newEndDate,
            type: "POST",
            // success: function (res) {
            //     console.log(res);
            // },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
            },
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
            {data: 'date', name: 'date', searchable: false},
            {data: 'barang', name: 'barang'},
            {data: 'type', name: 'type'},
            {data: 'stock_now', name: 'stock_now', searchable: false},
            {data: 'qty', name: 'qty', searchable: false},
            {data: 'last_stock', name: 'last_stock', searchable: false},
            {data: 'destination', name: 'destination'},
            {data: 'proyek', name: 'proyek'},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                title: 'Laporan Data Keluar Masuk Barang',
                messageTop: function() {
                    return 'Periode ' + $('input[name="daterangeBarangInOut"]').val()
                }
            },{
                extend: 'csv',
                title: 'This print was produced using the Print button for DataTables'
            }
            // {
            //     extend: 'print',
            //     text: '<img src="images/printer24x24.png" alt="Print">',
            //     titleAttr: 'Imprimir',
            //     title: '',
            //     columns: ':not(.select-checkbox)',
            //     orientation: 'landscape'
            // },
        ],
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
        
    });

    // $('#btnGenerateData').on('click', function() {
        
    // })

    function generateDatatables() {
        var date = $('input[name="daterangeBarangInOut"]').val();
        var type = $('select[name="selectTipe"]').val();
        var st = date.slice(0,10);
        var end = date.slice(15,25);
        var urlBaru = "/baranginout/"+type+"/"+st+"/"+end;
        myDt.ajax.url(urlBaru).load();
        // console.log(type);/
        // myDt.buttons();
    }

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
        // var urlTambah = ;
        // console.log(url);
        const formData = $('#tambahForm').serialize();
        let totalItem = $('#totalItem').val();
        let tertuju = $("input[name='tertuju']:checked").val();
        let lokasi = $('#selectTujuanIn').val();
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

        saveData('/baranginoutadd/', 'POST', data);
        // console.log(dataItem);
        // console.log($('barang-2').val());
    });

    $('#btn-keluar').on('click', function() {
        const formData = $('#keluarForm').serialize();
        let totalItem = $('#totalItemOut').val();
        // let tertuju = $("input[name='tertuju']:checked").val();
        let lokasi = $('#selectTujuanOut').val();
        let keterangan = $("textarea[name='keteranganOut']").val();

        let data = {
            tertuju: "ProyekKeluar",
            lokasi : lokasi,
            keterangan : keterangan,
            type: "Keluar"
        }

        let dataItem = [];
        let itemloop = 1;

        for (let i = 0; i < totalItem; i++) {
            let id_barang = $(`select[name='barangOut-${itemloop}']`).val();
            let qty = $(`input[name='qtyOut-${itemloop}']`).val();
            let price = $(`input[name='priceOut-${itemloop}']`).val();
            dataItem.push({
                id_barang,
                qty,
                price
            })

            itemloop += 1;
        }

        data.listItem = dataItem;

        saveData('/baranginoutadd/', 'POST', data);
        // console.log(data);
    })    

    function saveData(url, method, data){
        $.ajax({
            url: url,
            method: method,
            data: {
            data:data,
            },
            success: function(res){
                console.log(res);
                if (res == 'sukses') {
                    swal({
                        title: "Sukses!",
                        text: `Penambahan Material Berhasil Masuk Sistem !`,
                        icon: "success",
                        button : false,
                    });
                    setTimeout(function(){
                    window.location.reload();
                    }, 2000);
                }
            },
            error:function(error){
                console.log(error.responseText);
            }
        });

    }
</script>