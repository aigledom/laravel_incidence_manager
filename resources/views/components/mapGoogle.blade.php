<script>
    function distribuir() {
        if ("{{$pagina}}" == "show") {
            cargarMapa();
        } else {
            inicializarMapaCrear();
        }
    }

    var mapa;
    var marcador = null; // Variable para realizar un seguimiento del marcador actual
</script>
<script>
    function inicializarMapaCrear() {
        if ("{{$ubicacion}}" !== "") {
            var x = "{{isset($ubicacion)?json_decode('{'.$ubicacion.'}')->x:''}}";
            var y = "{{isset($ubicacion)?json_decode('{'.$ubicacion.'}')->y:''}}";
            var posicion = {
                lat: Number(y),
                lng: Number(x)
            };
            mapa = new google.maps.Map(document.getElementById("map"), {
                center: posicion,
                zoom: 17, // Nivel de zoom inicial
                mapTypeId: "satellite"
            });
            marcador = new google.maps.Marker({
                position: posicion,
                map: mapa,
                title: "Incidencia",
            });
            ubicacion.value = "{{$ubicacion}}".replaceAll('&quot;', '"');
        } else {
            mapa = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 42.849392465351734,
                    lng: -8.581981193370293
                },
                zoom: 17, // Nivel de zoom inicial
                mapTypeId: "satellite"
            });
        }

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
        }
    }

    function eliminarMarcador() {
        if (marcador) {
            marcador.setMap(null); // Elimina el marcador del mapa
        }
    }
</script>

<script>
    function cargarMapa() {
        console.log("entra");
        if (document.getElementById("map")) {
            inicializarMapa();
        } else {
            setTimeout(cargarMapa, 100);
        }
    }

    function inicializarMapa() {
        if ("{{$ubicacion}}" !== "") {
            var x = "{{isset($ubicacion)?json_decode('{'.$ubicacion.'}')->x:''}}";
            var y = "{{isset($ubicacion)?json_decode('{'.$ubicacion.'}')->y:''}}";
            var posicion = {
                lat: Number(y),
                lng: Number(x)
            };
            mapa = new google.maps.Map(document.getElementById("map"), {
                center: coords,
                zoom: 17, // Nivel de zoom inicial
                mapTypeId: "satellite"
            });
            const marcador = new google.maps.Marker({
                position: posicion,
                map: mapa,
                title: "Incidencia",
            });
        } else {
            document.getElementById("mapa").classList.add("mapa-vacio");
            document.getElementById("mapa").innerHTML = '<div style="width:100%"><i class="fa-solid fa-circle-exclamation"></i> @lang("messages.empty_map")<div>';
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&callback=distribuir" async defer></script>