<div id="modal-realisasi" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Realisasi Permintaan Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="" id="tambahForm">
                    {{ csrf_field() }}
                    <div class="form-row" >
                        <div class="col-md-12 m-2" id="form-to-replace">

                        </div>
                        <div class="col-md-12 m-2" id="table-to-replace">

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

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    let rowData;
    $(document).ready(function() {
        // console.log('okeeee');
        generateType('all');
    });

    function setTable(id) {
        // console.log(id);
        let url = `/listitemrequest/${id}`;
        // url.replace(':id', id);
        // console.log(url);
        $.ajax({
            dataType: "json",
            url : url,
            type: "GET",
            success: function(res) {
                console.log(res);
                // console.log("ini id Pro " + res.id);
                // console.log("ini id : "+res.id);
                // console.log(`#table-list-${res.id}`); 
                var listBarang = ``;
                var no=1;
                for (let j = 0; j < res.data.length; j++) {
                    // console.log(res);
                    listBarang += `<tr>
                                    <th scope="row">${no}</th>
                                    <td>${res.data[j].barang.name}</td>
                                    <td style="text-align:center">${res.data[j].qty}</td>
                                </tr>`;
                no++;
                }
                $(`#table-list-${res.id} tbody`).append(listBarang);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
                console.log(err.Message);
            }
        });
    }

    function setLabelStatus(id, status) {
        // console.log(id, status);
        let color;
        if (status == "Menunggu Konfirmasi") {
            color = 'text-warning';
            text = 'Perlu dikonfirmasi';
        }if (status == "Diproses") {
            color = 'text-primary';
            text = 'Dalam Pengiriman';
        }if (status == "Selesai") {
            color = 'text-success';
            text = 'Selesai';
        }
        // console.log(color);
        $(`#labelStatus-${id}`).addClass(color);
        $(`#labelStatus-${id}`).text(text);
    }

    function setFormatDate(params) {
        let date = new Date(params);
        let newDate = dayIndo(date.getDay()) + ", " + date.getDate() + " - " + date.getMonth() + " - " + date.getFullYear();

        return  newDate;

        function dayIndo(day) {
            const listDay = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            return listDay[day];
        }
    }

    function generateType(url) {
        $('#listData').empty();
        // console.log(url + "url");
        // console.log(url);
        // let newUrl = `/historyrequest/:type`;
        // console.log(newUrl.replace(':type', url));
        // rowData.ajax({url:newUrl}).load();
        $.ajax({
            dataType: "json",
            url : "/listrequest/"+url,
            type: "GET",
            success: function(res) {
                // console.log(dt);
                // let res = dt.data;
                // let total = dt.total;
                if (res.length == 0) {
                    $('#listData').append(`<div class="card-body">
                        <h4 style="text-align:center;">Tidak ada data untuk ditampilkan</h4>
                    </div>`);
                }else{
                    // $('#badge-semua').text(total[0].total + total[1].total + total[2].total)
                    // $('#badge-menunggu').text(total[1].total)
                    // $('#badge-diproses').text(total[0].total)
                    // $('#badge-selesai').text(total[2].total)

                    // let opt = ;
                    for (let i = 0; i < res.length; i++) {
                        $('#listData').append(`<div class="main-card m-2 p-2 card" id="list-${i}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6" style="background-color: " id="form-content-${res[i].id}">
                                        <h5 id="noref">No Referensi <b>: ${res[i].no_reference}</b></h5>
                                        <h5 id="status">Status <b class="" id="labelStatus-${res[i].id}">: </b></h5>
                                        <table style="width:100%">
                                            <tbody>
                                                <tr id="baris-tertuju">
                                                    <td style="width:40%">Tertuju</td>
                                                    <td >: <b style="text-align:center;">${res[i].project.name_project}</b></td>
                                                </tr>
                                                <tr id="baris-pengajuan">
                                                    <td style="width:40%">Tanggal Pengajuan</td>
                                                    <td >: <b style="text-align:center;">${setFormatDate(res[i].date_procurement)}</b></td>
                                                    </tr>
                                                    <tr id="baris-permintaan">
                                                    <td style="width:40%">Tanggal Permintaan</td>
                                                    <td >: <b style="text-align:center;">${setFormatDate(res[i].created_at)}</b></td>
                                                </tr>
                                                <tr id="baris-keterangan">
                                                    <td style="width:40%">Keterangan</td>
                                                    <td >: <b style="text-align:center;">${res[i].description == null ? '-' : res[i].description}</b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 removeClass" id="table-content-${res[i].id}">
                                    <h4 style="text-align:center">Data Barang</h4>
                                        <table class="mb-0 table table-sm" id="table-list-${res[i].id}">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th style="text-align:center">Nama Barang</th>
                                                <th style="text-align:center">Jumlah</th>
                                            </tr>
                                            </thead>
                                            <tbody>
    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>`);
                        
                        setTable(res[i].id);
                        setLabelStatus(res[i].id, res[i].status)
                        addButtonValidate(res[i].id, i, res[i].status)
                        // console.log(res[i].id);s
                    }
                
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
                console.log(err.Message);
            }
        })
    }
    function addButtonValidate(idData, id, status) {
        console.log(id);
        console.log(status);
        if (status == 'Menunggu Konfirmasi') {
        $('#list-'+id).append(`<div class="form-row">
                        <div class="mx-auto">
                            <input type="text" name="idData-${idData}" id="totalItem" value="${idData}" style="display:none;">
                            <button class="btn-shadow btn btn-info" onclick="realisasi(${idData})" id="btn-realisasi" data-id="${idData}" data-toggle="modal" data-target="#modal-realisasi">
                                Realisasi
                            </button>
                        </div>
                    </div>` );
        }
    }

    // $('#modal-realisasi').on('show.bs.modal', function() {
    //     $('#form-to-replace').empty();
    //     let index = $(this).
    //     let document = $('#form-content-0').html();
    //     // console.log(document);
    //     // console.log(typeof document);
    //     $('#form-to-replace').html(document);
    //     // $('#form-to-replace .removeClass').remove();



    //     // console.log(document);
    // })

    function realisasi(params) {
        $('#form-to-replace ').empty();
        $('#table-to-replace ').empty();
        let data = $('#form-content-'+params).html();
        let table = $('#table-content-'+params).html();
        $('#form-to-replace ').html(data);
        $('#table-to-replace ').html(table);
        let row = $('#table-to-replace table tbody').children();
        console.log(row);
        $('#table-to-replace table thead tr th:eq(2)').text('Permintaan');
        $('#table-to-replace table thead tr').append('<th style="width:20%">Jumlah Realisasi</th>');
        let column ='<td><input type="number"></td>';
        for (let i = 0; i < row.length; i++) {
            $(`#table-to-replace table tbody tr:eq(${i})`).append(column);
        }
    }
</script>
