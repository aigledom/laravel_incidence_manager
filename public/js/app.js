window.addEventListener("DOMContentLoaded", function () {
    //Código para hacer el cambio de idioma
    $(".changeLang").change(function () {
        var route = $(this).data('route');
        window.location.href = route + "?lang=" + $(this).val();
    });

    //Cambiar el fondo de la tabla al hacer hover
    var tableRows = document.querySelectorAll('table tbody tr')
    tableRows.forEach(function (row) {
        row.addEventListener('mouseover', function () {
            Array.from(this.children).forEach(function (td) {
                if (!td.classList.contains('colorEstado')) {
                    td.style.backgroundColor = 'rgba(0, 0, 0, 0.1)';
                }
            });
        });
        row.addEventListener('mouseout', function () {
            // Restaura el color original de los td al salir de la fila
            Array.from(this.children).forEach(function (td) {
                if (!td.classList.contains('colorEstado')) {
                    td.style.backgroundColor = '';
                }
            });
        });
    });
});

function callbackThen(response) {
    //console.log(response.status);
    response.json().then(function (data) {
        //console.log(data);
    });
}

function callbackCatch(error) {
    console.error('Error:', error)
}
