window.addEventListener("DOMContentLoaded", function () {
    //Si hay algun email duplicado se muestra el modal
    if (emailDuplicado) {
        $('#emailDuplicadoModal').modal('show');
    }
    // Define una acción para el botón de volver
    btnVolver.addEventListener("click", function () {
        window.history.back();
    });
});
