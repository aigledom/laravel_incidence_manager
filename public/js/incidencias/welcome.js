$(document).ready(function () {
    //Código para creación de DataTable
    let estado;
    DataTable.ext.search.push(function (settings, data, dataIndex) {
        estado = data;
        if (document.getElementById("estado").value == "-1") {
            return true;
        }
        if (data[0] == document.getElementById("estado").value) {
            return true;
        } else {
            return false;
        }
    });

    const table = $('#incidencias-table').DataTable({
        responsive: true,
        paging: true,
        autoWidth: false,
        dom: '<"top"lf<"filtro col-12 col-md-4 mx-auto">>r<"table-responsive w-100"t><"toolbar float-end">ip',
        language: {
            url: urlTraduccionDatatable,
        },
        columnDefs: [
            {
                targets: 7, // Índice de la columna que deseas modificar (0-indexed)
                render: function (data) {
                    // Si tiene más de 20 caracteres, devolver los 10 primeros + '...'
                    if (data.length > 25) return data.substr(0, 20) + '...';
                    return data;
                }
            },
            // Puedes agregar más definiciones de columna si es necesario
        ],
    });

    function poblarToolbar() {
        if (document.querySelector('div.toolbar') != null) {
            const crearButton = document.getElementById("crear");
            if (crearButton) {
                const toolbar = document.querySelector('div.toolbar');
                const crearButtonClone = crearButton.cloneNode(true);
                crearButton.remove();
                toolbar.appendChild(crearButtonClone);
            }
            return true;
        } else {
            setTimeout(poblarToolbar, 1); // Llamada recursiva a setTimeout
        }
    }

    // Llamar a la función por primera vez
    poblarToolbar();

    function poblarFiltro() {
        if (document.querySelector('div.filtro') != null) {
            const filtroInput = document.getElementById("estado-group");
            if (filtroInput) {
                const filtro = document.querySelector('div.filtro');
                const filtroInputClone = filtroInput.cloneNode(true);
                filtroInput.remove();
                filtro.appendChild(filtroInputClone);
                document.getElementById("filtrar").addEventListener('click', function () {
                    table.draw();
                })
            }
            return true;
        } else {
            setTimeout(poblarFiltro, 1); // Llamada recursiva a setTimeout
        }
    }
    poblarFiltro();

    //Cuando se cambia de indice de tabla pinta las incidencias
    $('#incidencias-table').on('draw.dt', function () {
        cambiarColorTabla();
    });

    //Codigo para cambiar el color del <tr> segun el estado
    cambiarColorTabla();
});

function cambiarColorTabla() {
    var filas = document.querySelectorAll("#incidencias-table tbody tr");
    filas.forEach(function (fila) {
        var estado = fila.getAttribute("data-estado");
        var celdas = fila.querySelectorAll(".colorEstado");
        celdas.forEach(function (celda) {
            celda.style.backgroundColor = "white";
        });
        celdas.forEach(function (celda) {
            //Estado sin resolver
            if (estado == "0") {
                celda.style.backgroundColor = "#dc3545";
                //Estado en proceso
            } else if (estado == "1") {
                celda.style.backgroundColor = "#ffc107";
                //Estado resuelto
            } else if (estado == "2") {
                celda.style.backgroundColor = "#28a745";
            }
        });
    });
}
