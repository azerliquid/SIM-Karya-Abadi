<script>
    var startDate = {!! json_encode($start) !!};
    var endDate = {!! json_encode($end) !!};

    // console.log(endDate);
    var newStartDate = moment(startDate).format('DD-MM-YYYY');
    var newEndDate = moment(endDate).format('DD-MM-YYYY');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    idBarang = {!! json_encode($barang->id) !!};
    
    var type = $('select[name="selectTipe"]').val();

    var myDt = $('#tableDetail').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "/detailbarang/"+idBarang+'/'+newStartDate+'/'+newEndDate+'/'+type,
            type: 'GET',
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
            {data: 'qty', name: 'unit'},
            {data: 'destination', name: 'destination'},
            {data: 'location', name: 'location'},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },
        // "createdRow": function( row, data, dataIndex ) {
        //     // console.log(data.type);
        //     if ( data.type == "Masuk" ) {        
        //         $(row).addClass('bg-light text-dark');
        //     }else{
        //         $(row).addClass('bg-dark text-light'); 
        //     }
        // }
    });

    $('input[name="daterangeBarang"]').daterangepicker({
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

    function generateDatatables() {
        var date = $('input[name="daterangeBarang"]').val();
        var type = $('select[name="selectTipe"]').val();
        var st = date.slice(0,10);
        var end = date.slice(15,25);
        var urlBaru = "/detailbarang/"+idBarang+'/'+st+"/"+end+'/'+type;
        myDt.ajax.url(urlBaru).load();
        // console.log(type);/
        // myDt.buttons();
    }
    
</script>