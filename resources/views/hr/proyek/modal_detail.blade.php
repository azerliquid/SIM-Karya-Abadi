<script>
    
    var startDate = {!! json_encode($start) !!};
    var idProyek = {!! json_encode($project->id) !!};
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


    var tbDtl = $('#tableDetail').DataTable({
        ajax:{
            url: "/proyek/detail/"+idProyek+'/'+newStartDate+'/'+newEndDate,
            type: 'PUT',
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
            {data: 'barang', name: 'barang'},
            {data: 'qty', name: 'qty'},
            {data: 'price', name: 'price', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
            {data: 'total', name: 'total', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },  
        columnDefs: [
                // Center align the header content of column 1
            { className: "dt-head-center", targets: [ 0, 1, 2, 3, 4, 5] }
        ]
    
    });

    var tbSum = $('#tableSumBarang').DataTable({
        ajax:{
            url: '/proyek/alocated/'+idProyek+'/'+newStartDate+'/'+newEndDate,
            type: 'PUT',
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
            },
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'barang', name: 'barang'},
            {data: 'total', name: 'total'},
            {data: 'pemakaian', name: 'pemakaian', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },    
        initComplete: function(data) {
            $('#sumPemakaian').text(new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(data.json.sumPemakaian))
        }
    });

    function generateDatatables() {
        var date = $('input[name="daterangeBarangInOut"]').val();
        var st = date.slice(0,10);
        var end = date.slice(15,25);
        var urlBarutbDtl = "/proyek/detail/"+idProyek+"/"+st+"/"+end;
        var urlBarutbSum = "/proyek/alocated/"+idProyek+"/"+st+"/"+end;
        tbDtl.ajax.url(urlBarutbDtl).load();
        tbSum.ajax.url(urlBarutbSum).load();
        // console.log(type);/
        // myDt.buttons();
    }

    
</script>   