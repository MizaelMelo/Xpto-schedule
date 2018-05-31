
 $(document).ready(function () {
    
    $("#message").modal("show");

    $('#agenda').DataTable({
        "language": {
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo"
            },
            "lengthMenu": "Mostrar _MENU_ linhas",
            "search": "Pesquisar",
            "zeroRecords": "Nenhum dado encontrado",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ linhas",
            "infoEmpty": "Mostrando 0 a 0 de 0 linhas",
            "infoFiltered": "(Filtrado de um total de _MAX_ linhas)",

        }
    });

    $("#btnExport").click(function () {
        $("#agenda").btechco_excelexport({
            containerid: "agenda",
            datatype: $datatype.Table,
            filename: 'sample'
        });
    });
 });
