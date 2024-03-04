<div x-data="{ isOpen: false }">
    <div class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column p-2" id="sidebar" x-ref="sidebar">
        <div class="accordion nav flex-column text-white w-100" id="accordionPanelsStayOpenExample">
            @php $seleccionado = explode(".",Route::currentRouteName())[0] @endphp
            <h3 class="p-2">@lang("messages.panelGestion")</h3>
            <div class="nav-link accordion-item">
                <h2 class="accordion-header" id="usersCollapseButton">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelUsersCollapse" aria-expanded="false" aria-controls="panelUsersCollapse">
                        @lang("messages.usuarios")
                    </button>
                </h2>
                <div id="panelUsersCollapse" class="accordion-collapse collapse {{$seleccionado == 'usuarios'?'show':''}}" aria-labelledby="usersCollapseButton">
                    <div class="accordion-body d-flex flex-column">
                        <a href="{{ route('usuarios.create') }}">@lang("messages.crearUsuarios")</a>
                        <a href="{{ route('usuarios.index') }}">@lang("messages.panelUsuarios")</a>
                    </div>
                </div>
            </div>
            <div class="nav-link accordion-item">
                <h2 class="accordion-header" id="incidenciasCollapseButton">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelIncidenciasCollapse" aria-expanded="false" aria-controls="panelIncidenciasCollapse">
                        @lang("messages.incidencias")
                    </button>
                </h2>
                <div id="panelIncidenciasCollapse" class="accordion-collapse collapse {{$seleccionado == 'incidencias'?'show':''}}" aria-labelledby="incidenciasCollapseButton">
                    <div class="accordion-body d-flex flex-column">
                        <a href="{{ route('incidencias.index') }}">@lang("messages.crearIncidencias")</a>
                        <a href="{{ route('incidencias.welcome') }}">@lang("messages.panelIncidencias")</a>
                    </div>
                </div>
            </div>
            <div class="nav-link accordion-item">
                <h2 class="accordion-header" id="categoriasCollapseButton">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelCategoriasCollapse" aria-expanded="false" aria-controls="panelCategoriasCollapse">
                        @lang("messages.categorias")
                    </button>
                </h2>
                <div id="panelCategoriasCollapse" class="accordion-collapse collapse {{$seleccionado == 'categorias'?'show':''}}" aria-labelledby="categoriasCollapseButton">
                    <div class="accordion-body d-flex flex-column">
                        <a href="{{ route('categorias.create') }}">@lang("messages.crearCategorias")</a>
                        <a href="{{ route('categorias.show') }}">@lang("messages.panelCategorias")</a>
                    </div>
                </div>
            </div>
            <div class="nav-link accordion-item">
                <h2 class="accordion-header" id="empresasCollapseButton">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelEmpresasCollapse" aria-expanded="false" aria-controls="panelEmpresasCollapse">
                        @lang("messages.empresas")
                    </button>
                </h2>
                <div id="panelEmpresasCollapse" class="accordion-collapse collapse {{$seleccionado == 'empresas'?'show':''}}" aria-labelledby="empresasCollapseButton">
                    <div class="accordion-body d-flex flex-column">
                        <a href="{{ route('empresas.create') }}">@lang("messages.crearEmpresas")</a>
                        <a href="{{ route('empresas.show') }}">@lang("messages.panelEmpresas")</a>
                    </div>
                </div>
            </div>
            <div class="nav-link accordion-item">
                <h2 class="accordion-header" id="opcionesCollapseButton">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelOpcionesCollapse" aria-expanded="false" aria-controls="panelOpcionesCollapse">
                        @lang("messages.opciones")
                    </button>
                </h2>
                <div id="panelOpcionesCollapse" class="accordion-collapse collapse {{$seleccionado == 'admin'?'show':''}}" aria-labelledby="opcionesCollapseButton">
                    <div class="accordion-body d-flex flex-column">
                        <a href="{{ route('admin.index') }}">@lang("messages.camposIncidencias")</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Wrapper -->
    <div class="p-1 my-container active-cont">
        <!-- Top Nav -->
        <nav class="">
            <a class="btn border-0" id="menu-btn"><i class="fa-solid fa-bars"></i></a>
        </nav>
    </div>
</div>
@vite(['resources/js/components/sidenavbar.js'])
@vite(['resources/css/components/sidenavbar.css'])