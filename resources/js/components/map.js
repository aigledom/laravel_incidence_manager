import Map from "ol/Map.js";
import View from "ol/View.js";
import TileLayer from "ol/layer/Tile.js";
import OSM from "ol/source/OSM.js";
import VectorLayer from 'ol/layer/Vector';
import VectorSource from 'ol/source/Vector';
import Feature from 'ol/Feature';
import Point from 'ol/geom/Point';
import Style from 'ol/style/Style';
import Icon from 'ol/style/Icon';
import { useGeographic } from 'ol/proj';

useGeographic();

var latitud, long, marker;
if (coords) {
    latitud = coords.lat;
    long = coords.lng;
    marker = new Feature({
        geometry: new Point([long, latitud]), // Crea una característica en las coordenadas del clic
    });

    marker.setStyle(
        new Style({
            image: new Icon({
                src: iconUrl,
                scale: 0.3,
            }),
        })
    );
} else {
    latitud = 42.849392465351734;
    long = -8.581981193370293;
}
const ZOOM = 16;

const map = new Map({
    target: 'map',
    layers: [
        new TileLayer({
            source: new OSM(),
        }),
    ],
    view: new View({
        center: [long, latitud],
        zoom: ZOOM,
    }),
});

const vectorSource = new VectorSource(); // Crea una fuente de capa vectorial

const vectorLayer = new VectorLayer({
    source: vectorSource, // Asigna la fuente a la capa vectorial
});

map.addLayer(vectorLayer); // Agrega la capa vectorial al mapa
let lastMarker
if (marker) {
    vectorSource.addFeature(marker);
    lastMarker = marker;
} else { lastMarker = null; }
// Variable para llevar un seguimiento de la última característica añadida
if (pagina !== "show") {
    map.on('singleclick', function (evt) {
        var coordinates = evt.coordinate; // Obtiene las coordenadas del clic
        let ubicacion = document.getElementById("ubicacion");
        ubicacion.value = '"x":' + coordinates[0] + ',"y":' + coordinates[1];

        // Elimina el marcador existente si lo hay
        if (lastMarker) {
            vectorSource.removeFeature(lastMarker);
        }

        const marker = new Feature({
            geometry: new Point(coordinates), // Crea una característica en las coordenadas del clic
        });

        marker.setStyle(
            new Style({
                image: new Icon({
                    src: iconUrl,
                    scale: 0.3,
                }),
            })
        );

        vectorSource.addFeature(marker); // Agrega la característica a la fuente de la capa vectorial

        lastMarker = marker; // Actualiza la última característica añadida
    });
} else {
    if (!coords) {
        document.getElementById("map").classList.add("mapa-vacio");
        
        var msgError = document.getElementById("msgMapError").textContent;
        document.getElementById("map").innerHTML = '<div style="width:100%"><i class="fa-solid fa-circle-exclamation"></i> ' + msgError + '<div>';
        document.getElementById("msgMapError").outerHTML = "";
    }
}

map.updateSize();
