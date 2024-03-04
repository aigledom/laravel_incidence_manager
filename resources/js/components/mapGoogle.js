let mapa;
let marcador = null; // Variable para realizar un seguimiento del marcador actual

console.log("Hola");
function inicializarMapa() {
    const coordenadasIniciales = {
        lat: 42.849392465351734,
        lng: -8.581981193370293
    }; // Coordenadas iniciales del mapa
    mapa = new google.maps.Map(document.getElementById("mapa"), {
        center: coordenadasIniciales,
        zoom: 17, // Nivel de zoom inicial
        mapTypeId: "satellite"
    });

    // Habilita la capacidad de hacer clic para agregar un único marcador
    mapa.addListener("click", function(event) {
        eliminarMarcador(); // Elimina el marcador anterior (si existe)
        agregarMarcador(event.latLng);
    });
}

function agregarMarcador(posicion) {
    marcador = new google.maps.Marker({
        position: posicion,
        map: mapa,
        title: "Marcador personalizado",
    });
    if (marcador) {
        const posicionMarcada = marcador.getPosition();
        const latitud = posicionMarcada.lat();
        const longitud = posicionMarcada.lng();
        let ubicacion = document.getElementById("ubicacion");
        ubicacion.value = '"x":' + longitud + ',"y":' + latitud;

        // Puedes utilizar latitud y longitud como desees, por ejemplo, enviarlos al servidor o mostrarlos en la página.
    }
    // Aquí puedes enviar la información del marcador al servidor o realizar otras acciones.
}

function eliminarMarcador() {
    if (marcador) {
        marcador.setMap(null); // Elimina el marcador del mapa
    }
}
