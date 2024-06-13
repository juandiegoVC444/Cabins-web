$("#tabla").DataTable({
    language: {
        lengthMenu: "Mostrar " +
                    `<select class="custom-select custom-select-sm form-control form-control-sm" >
                    <option value='5'>5</option>
                    <option value='10'>10</option>
                    <option value='25'>25</option>
                    <option value='50'>50</option>
                    <option value='100'>100</option>
                    <option value='-1'>Todos</option>
                    </select>`+
                    " registros por página",
        zeroRecords: "Nada encontrado - disculpa",
        info: "Mostrando la página _PAGE_ de _PAGES_",
        infoEmpty: "No records available",
        infoFiltered: "(filtrado de _MAX_ registros totales)",
        search: "Buscar",
        paginate: {
            next: "Siguiente",
            previous: "Anterior",
        },
    },
});
