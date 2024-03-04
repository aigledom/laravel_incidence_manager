window.addEventListener("DOMContentLoaded", function () {
    // Rescato la información de las imágenes que tiene esa persona
    var imagenesDataElement = document.getElementById('imagenes-data');
    // Accede a los datos a través del atributo data-imagenes a menos de que sea nulo
    if (!imagenesDataElement) return;
    var imagenes = JSON.parse(imagenesDataElement.getAttribute('data-imagenes'));

    // Generar miniaturas
    var miniaturaContainer = document.getElementById('miniaturaContainer');
    var numMiniaturas = imagenes.length;
    var activeIndex = 0;
    generarMiniaturas(activeIndex);

    // Control de miniaturas
    var thumbnails = document.querySelectorAll('.thumbnail');
    thumbnails.forEach(function (thumbnail, index) {
        thumbnail.addEventListener('click', function () {
            // Actualiza la miniatura activa al hacer clic en una miniatura
            activeIndex = index;
            generarMiniaturas(activeIndex);
        });
    });

    // Agrega el evento de cambio de carrusel
    var imageCarousel = document.getElementById('imageCarousel');
    imageCarousel.addEventListener('slide.bs.carousel', function (e) {
        generarMiniaturas(e.to);
    });

    function generarMiniaturas(activeIndex) {
        // Limpia el contenido del contenedor de miniaturas
        miniaturaContainer.innerHTML = '';
        for (var i = activeIndex - 1; i <= activeIndex + 1; i++) {
            if (i >= 0 && i < numMiniaturas) {
                var miniatura = document.createElement('div');
                miniatura.className = 'thumbnail p-0 mx-2';
                miniatura.setAttribute('data-bs-target', '#imageCarousel');
                miniatura.setAttribute('data-bs-slide-to', i);

                var img = document.createElement('img');
                img.src = '../storage/uploads/' + imagenes[i];
                img.className = 'miniatura border border-secondary-subtle rounded';
                img.alt = 'Thumbnail';

                miniatura.appendChild(img);
                miniaturaContainer.appendChild(miniatura);
            }
        }
    }
});
