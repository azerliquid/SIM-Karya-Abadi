<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function(params) {
        idBarang = {!! json_encode($barang->id) !!};
        var url ="/detailBarang/"+idBarang;
        console.log(url);

        $.ajax({
            url: url,
            type: 'PUT',
            success: function(res) {
                console.log(res);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
            },
        })

        $('#tableDetail').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: url,
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
    })
    
</script>