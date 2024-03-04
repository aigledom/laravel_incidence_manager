document.addEventListener("DOMContentLoaded", function () {
    //Añade un listener para cambiar el icono cuando este se pulsa
    const toggleButton = document.getElementById('toggleButton');
    const icon = toggleButton.querySelector('i');
    toggleButton.addEventListener('click', function () {
        if (icon.classList.contains('fa-plus')) {
            icon.classList.remove('fa-plus');
            icon.classList.add('fa-minus');
        } else {
            icon.classList.remove('fa-minus');
            icon.classList.add('fa-plus');
        }
    });

    //Cambio de los colores de la barra de option
    var select = document.getElementById("estado");
    var options = select.getElementsByTagName("option");
    cambiaColor(select, options);
    select.addEventListener("change", function () {
        cambiaColor(select, options);
    });
});

function cambiaColor(select, options) {
    var selectedOption = options[select.selectedIndex];
    if (selectedOption.value == "0") {
        select.style.backgroundColor = "#dc3545";
    } else if (selectedOption.value == "1") {
        select.style.backgroundColor = "#ffc107";
    } else if (selectedOption.value == "2") {
        select.style.backgroundColor = "#28a745";
    }
    //Pone el background de los option transparente
    for (var i = 0; i < options.length; i++) {
        options[i].style.backgroundColor = "white";
    }
}
