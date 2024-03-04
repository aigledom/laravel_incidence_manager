$(document).ready(function () {
    const table = $('#categorias-table').DataTable({
        paging: true,
        autoWidth: false,
        dom: 'lfrt<"toolbar">ip',
        language: {
            url: urlTraduccionDatatable,
        },
    });
    crear = document.getElementById("crear").outerHTML;
    document.getElementById("crear").outerHTML = "";
    document.querySelector('div.toolbar').innerHTML = crear;
    document.querySelector('div.toolbar').style.float = "left";
});
