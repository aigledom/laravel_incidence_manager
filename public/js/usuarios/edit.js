window.addEventListener("DOMContentLoaded", function () {
    //Si existe un rol de usuario se llena el select
    /*if (rolUsuario != null) {
        // Función para cargar y procesar el archivo JSON
        function loadJSON(callback) {
            var xobj = new XMLHttpRequest();
            xobj.overrideMimeType("application/json");
            xobj.open('GET', '../../json/roles.json', true);
            xobj.onreadystatechange = function () {
                if (xobj.readyState == 4 && xobj.status == "200") {
                    callback(JSON.parse(xobj.responseText));
                }
            };
            xobj.send(null);
        }

        // Llama a la función para cargar el archivo JSON
        loadJSON(function (data) {
            var select = document.getElementById("rol");
            data.roles.forEach(function (role) {
                var option = document.createElement("option");
                option.value = role.name.toLowerCase();
                option.textContent = role.name;
                select.appendChild(option);
            });
            select.value = rolUsuario;
        });
    }*/
    //Si hay algun email duplicado se muestra el modal
    if (emailDuplicado) {
        $('#emailDuplicadoModal').modal('show');
    }
    // Define una acción para el botón de volver
    btnVolver.addEventListener("click", function () {
        window.history.back();
    });
});
