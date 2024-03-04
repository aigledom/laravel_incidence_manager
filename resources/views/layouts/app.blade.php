<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Web de gestión de incidencias')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Implementaciones-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!--Validacion DNI,CIF,NIE-->
    <script type="text/javascript" src="{{asset('js/validate_spanish_id.js')}}"></script>
    <!--Links a css y js propios-->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <!--Definir el link correspondiente al idioma para Jquery DataTables-->
    <script>
        var urlTraduccionDatatable = "{{__('messages.urlTraduccionDatatable')}}"
    </script>
    <!--Muestra icono Captcha en la parte inferior derecha-->
    @stack('styles')
    @stack('scripts')

    @php
    $languageDirectories = scandir(resource_path('lang'));
    $languages = array_filter($languageDirectories, function ($dir) {
    return !in_array($dir, ['.', '..']) && is_dir(resource_path('lang/' . $dir));
    });
    @endphp

    <!--Recoge el rol actual del usuario-->
    @php
    $link = "Documentación web de incidencias - ";
    if(auth()->check()){
    $rol = auth()->user()->rol;
    if($rol == "admin") {
    $link .= "Administrador.pdf";
    } else {
    if($rol == "gestor") {
    $link .= Gestor.pdf;
    } else {
    $link .= "Empleado_Responsable.pdf";
    }
    }
    } else {
    $link .= "Usuario anónimo.pdf";
    }
    @endphp

    <!--Cargar un modal si es necesario-->
    @if (isset($actualizado))
    <script type="text/javascript" src="{{asset('js/components/showModal.js')}}"></script>
    @endif
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm bg-dark justify-content-between p-4">
            <a href="/" class="mx-2 d-flex nav-link">
                <img id="logo" src="{{asset('imgs/oops_logo.png')}}" alt="Logo de gestión de problemas" class="img-fluid rounded">
                <h3 class="text-light ms-3 my-auto d-sm-inline-block d-none">@lang('messages.incidencias')</h3>
            </a>
            <ul class="navbar-nav d-flex flex-row align-items-center justify-content-center">
                <!--Link panel de control-->
                <li class="nav-item m-auto mx-2" {{ auth()->check()?"":"hidden"}}>
                    <a class="nav-link text-light" href="{{ route('incidencias.welcome') }}">
                        <i class="fs-sm-6 p-3 p-sm-0 fs-3 fa-solid fa-house"></i>
                        <span class="d-sm-inline-block d-none">@lang('messages.inicio')</span>
                    </a>
                </li>
                <!--Link crear nueva incidencia-->
                <li class="nav-item m-auto mx-2" {{ auth()->check()?"hidden":""}}>
                    <a class="nav-link text-light" href="{{ route('incidencias.index') }}">
                        <i class="fs-sm-6 p-3 p-sm-0 fs-3 fa-solid fa-square-plus"></i>
                        <span class="d-sm-inline-block d-none">@lang('messages.create_incidencia')</span>
                    </a>
                </li>
                <!--Link gestión sesión-->
                <li class="nav-item m-auto mx-2">
                    <a class="nav-link text-light" href="{{ auth()->check()?route('admin.logout'):route('login')}}">
                        <i class="fs-sm-6 p-3 p-sm-0 fs-3 fa-solid fa-screwdriver-wrench"></i>
                        <span class="d-sm-inline-block d-none">
                            @auth
                            @lang('messages.admin_logout')
                            @else
                            @lang('messages.eres_admin')
                            @endauth
                        </span>
                    </a>
                </li>
                <!--Select idioma-->
                <li class="nav-item m-auto mx-2">
                    <div class="row">
                        <div class="d-xs-inline-block d-none">
                            <select class="form-control changeLang" data-route="{{ route('changeLang') }}">
                                @foreach($languages as $language)
                                <option value={{$language}} {{ session()->get('locale') == $language ? 'selected' : '' }}>@lang("messages.$language")</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <div id="mainContainer" class="d-flex">
        @if($nivel = App\Models\Consultas::getNivel())
        @if($nivel>=2)
        <div id="sideContainer" class="active-nav"> <x-side-navbar /></div>
        @endif
        @endif
        <main class="container-fluid overflow-x-scroll">
            @yield('content')
        </main>
    </div>
    <!-- Footer -->
    <footer class="bg-dark py-2" id="footer">
        <div class="container my-auto">
            <ul id="enlacesFooter" class="w-100 d-flex align-items-center justify-content-around my-2">
                <!--Link aviso legal-->
                <li class="nav-item">
                    <a href="{{ route('aviso_legal') }}" class="nav-link text-light">
                        <i class="fs-sm-6 p-3 p-sm-0 fs-3 fa-solid fa-scale-balanced"></i>
                        <span class="d-sm-inline-block d-none">Aviso legal</span>
                    </a>
                </li>
                <!--Link aviso de cookies-->
                <li class="nav-item">
                    <a href="{{ route('aviso_cookies') }}" class="nav-link text-light">
                        <i class="fs-sm-6 p-3 p-sm-0 fs-3 fa-solid fa-cookie"></i>
                        <span class="d-sm-inline-block d-none">Aviso de cookies</span>
                    </a>
                </li>
                <!--Link manual de usuario-->
                <li class="nav-item m-auto mx-1">
                    <a class="nav-link text-light" href="{{asset('files/'.$link)}}" target="_blank">
                        <i class="fs-sm-6 p-3 p-sm-0 fs-3 fa-solid fa-file-pdf"></i>
                        <span class="d-sm-inline-block d-none">Manual de usuario</span>
                    </a>
                </li>
            </ul>
        </div>
    </footer>

    <!--Scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>