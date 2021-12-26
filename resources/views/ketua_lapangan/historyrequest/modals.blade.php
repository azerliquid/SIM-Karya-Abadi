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
        let url = `/listitem/${id}`;
        // url.replace(':id', id);
        $.ajax({
            dataType: "json",
            url : url,
            type: "GET",
            success: function(res) {
                // console.log(res);
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
                                    ${cekStatus(res.data[j].status, res.data[j].qty_alocated, res.data[j].id)}
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

    function setHeaderTable(id, status) {
        if (status == 'Diproses' || status == 'Selesai') {
            let table = $(`#table-content-${id} table thead tr`);
            table.append('<th style="text-align:center">Alokasi</th>');
        }
    }
    function cekStatus(status, qty_alocated, idtable) {
        // console.log(idtable);
        if (status == 'Diproses' || status == 'Selesai') {
            $(`#tabel-list-${idtable} thead tr`).append('<tr>Alokasi</tr>');
            return `<td style="text-align:center">${qty_alocated}</td>`;
        }
    }

    function setLabelStatus(id, status) {
        // console.log(id, status);
        let color;
        if (status == "Menunggu Konfirmasi") {
            color = 'text-warning';
        }if (status == "Diproses") {
            color = 'text-primary';
        }if (status == "Selesai") {
            color = 'text-success';
        }
        // console.log(color);
        $(`#labelStatus-${id}`).addClass(color);
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
            url : "/historyrequest/"+url,
            type: "GET",
            success: function(res) {
                if (res.length == 0) {
                    $('#listData').append(`<div class="card-body">
                        <h4 style="text-align:center;">Tidak ada data untuk ditampilkan</h4>
                    </div>`);
                }else{

                    // let opt = ;
                    for (let i = 0; i < res.length; i++) {
                        $('#listData').append(`<div class="main-card m-2 p-2 card" id="list-${i}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6" style="background-color: ">
                                        <h5 id="noref">No Referensi <b>: ${res[i].no_reference}</b></h5>
                                        <h5 id="status">Status <b class="" id="labelStatus-${res[i].id}">: ${res[i].status}</b></h5>
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
                        setHeaderTable(res[i].id, res[i].status)
                        addButtonValidate(res[i].id, i, res[i].status)
                        // console.log();
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
        // console.log(idData);
        // console.log(status);
        if (status == 'Diproses') {
        $('#list-'+id).append(`<div class="form-row">
                        <div class="mx-auto">
                            <button class="btn-shadow btn btn-info" onclick="konfirmasi(${idData})" id="btn-realisasi" data-id="${idData}">
                                Konfirmasi Diterima
                            </button>
                        </div>
                    </div>` );
        }
    }

    function konfirmasi(idData) {
        $.ajax({
            url : `/confirmrequest/${idData}`,
            method: 'GET',
            data: idData,
            success: function(res) {
                console.log(res);
                if (res == 'sukses') {
                    swal({
                        title: "Sukses!",
                        text: `Konfirmasi Permintaan Material Berhasil Masuk Sistem !`,
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
        })
    }
</script>
