$(document).ready(function () {
    const table = $('#empresas-table').DataTable({
        paging: true,
        autoWidth: false,
        dom: 'lfr<"table-responsive w-100"t><"toolbar">ip',
        language: {
            url: urlTraduccionDatatable,
        },
    });


    function poblarToolbar() {
        if (document.querySelector('div.toolbar') != null) {
            const crearButton = document.getElementById("crear");
            if (crearButton) {
                const toolbar = document.querySelector('div.toolbar');
                const crearButtonClone = crearButton.cloneNode(true);
                crearButton.remove();
                toolbar.appendChild(crearButtonClone);
                toolbar.style.float = "right";
            }
            return true;
        } else {
            setTimeout(poblarToolbar, 1); // Llamada recursiva a setTimeout
        }
    }

    // Llamar a la función por primera vez
    poblarToolbar();
});
