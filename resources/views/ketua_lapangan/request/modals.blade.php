<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    let barang;
    let index_select = 2;

    $(document).ready(function(params) {
        // $('.datepicker').datetimepicker({
        //     format: 'dd/mm/yyyy'
        // });
        let proyek;
        $.ajax({
            dataType: "json",
            url : '/request/create',
            type: "GET",
            success: function(res) {
                // console.log(res);
                
                barang = res;
                setSelectOpt(1, res);
                
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

    

    function setSelectOpt(index, brg) {
        // console.log(brg);
        for (let i = 0; i < brg.length; i++) {
            let opt = `<option value='${brg[i].id}' style="" data-stock='${brg[i].stock_now}' data-satuan='${brg[i].unit}'>${brg[i].name} (${brg[i].unit})</option>`;
            $(`#selectBarang-${index}`).append(opt);
        }
        // $().select2();
        $(`#selectBarang-${index}`).each((_i, e) => {
            var $e = $(e);
            $e.select2({
                dropdownParent: $e.parent()
            });
        })
    }

    function addItem() {
        event.preventDefault();
        // console.log('oke');
        $('.inputItem').append(
            `<div class="form-row children">
                <div class="col-md-7">
                    <div class="position-relative form-group" id="tambah-barang-masuk">
                        <label for="name-barang" class="">Nama Barang Masuk</label>
                        <select type="select" onchange="getStock(${index_select})" id="selectBarang-${index_select}" name="barang-${index_select}" class="custom-select selectBarang">
                            <option style='font-weight: bolder;' value=''>-- Pilih Barang --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative form-group" id="request-stock-available">
                        <label for="exampleText" class="">Stok Tersedia</label>
                        <input name="stock-${index_select}" id="exampleText" class="form-control" type="number" disabled></input>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position-relative form-group" id="tambah-stock_in">
                        <label for="exampleText" class="">Permintaan</label>
                        <input name="qty-${index_select}" id="exampleText" class="form-control" type="number"></input>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="position-relative form-group" id="request-stock_in">
                        <label for="exampleText" class="">Satuan</label>
                        <br>
                        <label id="satuan-${index_select}" class="" style="font-weight: bold"></label>
                    </div>
                </div>
            </div>`
        );

        setSelectOpt(index_select, barang);
        let total = $('#totalItem').val(index_select);
        // console.log("total : " + $('#totalItem').val());
        // console.log(index_select);
        index_select = index_select + 1;
        // console.log("val : "+ $('#totalItem').val());
    }

    $('.selectBarang').each(function() {
        // console.log($(this));
    })

    function getStock(params) {
        // console.log(params);
        let index = params
        let stock = $(`#selectBarang-${params}`).select2('data')[0].element.dataset.stock;
        let satuan = $(`#selectBarang-${params}`).select2('data')[0].element.dataset.satuan;
        setStockNow(index, stock, satuan);
    }

    // $('.datepicker').datepicker();

    function setStockNow(index, stock, satuan) {
        $(`label[id="satuan-${index}"]`).text('');
        $(`input[name="stock-${index}"]`).val(stock);
        $(`label[id="satuan-${index}"]`).text(satuan);
    }

    $('#btnTambah').on('click', function() {
        var url = '/request/store';
        console.log('oke');
        const formData = $('#tambahForm').serialize();
        let totalItem = $('#totalItem').val();
        let keterangan = $("textarea[name='keterangan']").val();
        // console.log(keterangan);
        let data = {
            keterangan : keterangan,
            type: "Keluar"
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
    })
</script>