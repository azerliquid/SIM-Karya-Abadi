<script>
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function(params) {
        idProyek = {!! json_encode($project->id) !!};
        var url ="/proyek/detail/"+idProyek;
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
                {data: 'barang', name: 'barang'},
                {data: 'qty', name: 'qty'},
            ],
            language: {
                emptyTable: "Tidak ada data tersedia",
            },
        
        });
    })
    
</script>   