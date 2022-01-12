<script>
    
    var startDate = {!! json_encode($start) !!};
    var idProyek = {!! json_encode($project->id) !!};
    var project = {!! json_encode($project->name_project) !!};
    var endDate = {!! json_encode($end) !!};

    var newStartDate = moment(startDate).format('DD-MM-YYYY');
    var newEndDate = moment(endDate).format('DD-MM-YYYY');
    var dateForTitleExport;


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
        dateForTitleExport = $('input[name="daterangeBarangInOut"]').val();
        console.log(dateForTitleExport);
    });


    var tbDtl = $('#tableDetail').DataTable({
        ajax:{
            url: "/logistik/proyek/detail/"+idProyek+'/'+newStartDate+'/'+newEndDate,
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
            {data: 'qty', name: 'qty', className: 'dt-body-center'},
            {data: 'price', name: 'price', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
            {data: 'total', name: 'total', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },  
        columnDefs: [
                // Center align the header content of column 1
            { className: "dt-head-center", targets: [ 0, 1, 2, 3, 4, 5] },
        ],
        
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                title: 'Laporan Data Keluar Masuk Barang',
                messageTop: function() {
                    return 'Periode &nbsp: ' + dateForTitleExport +
                    '<br>' +
                    'Proyek &nbsp: ' + project
                },
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' );
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                }
            },
            {
                extend: 'csv',
                title: `Laporan Keluar Masuk Barang ${dateForTitleExport}`
            },
            {
                extend: 'pdf',
                title: `Laporan Keluar Masuk Barang ${dateForTitleExport}`
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

    var tbSum = $('#tableSumBarang').DataTable({
        ajax:{
            url: '/logistik/proyek/alocated/'+idProyek+'/'+newStartDate+'/'+newEndDate,
            type: 'PUT',
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
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'barang', name: 'barang'},
            {data: 'total', name: 'total'},
            {data: 'pemakaian', name: 'pemakaian', className: 'dt-body-right', render: $.fn.dataTable.render.number( '.', ',', 2, 'Rp ' )},
        ],
        language: {
            emptyTable: "Tidak ada data tersedia",
        },    
        "drawCallback": function (dt) { 
            var response = dt.json;
            if (response != undefined) {
                // dataTableSum = response;
                $('#sumPemakaian').text(new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(response.sumPemakaian))

                // console.log(response.sumPemakaian);
            }
        },
        // initComplete: function(data) {
        //     // console.log(data.json.sumPemakaian);
        //     $('#sumPemakaian').text(new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(data.json.sumPemakaian))
        // },
    });

    function generateDatatables() {
        var date = $('input[name="daterangeBarangInOut"]').val();
        var st = date.slice(0,10);
        var end = date.slice(15,25);
        var urlBarutbDtl = "/logistik/proyek/detail/"+idProyek+"/"+st+"/"+end;
        var urlBarutbSum = "/logistik/proyek/alocated/"+idProyek+"/"+st+"/"+end;
        tbDtl.ajax.url(urlBarutbDtl).load();
        tbSum.ajax.url(urlBarutbSum).load();
        // console.log(tbSum);
        // console.log(type);/
        // myDt.buttons();
    }

    
</script>   