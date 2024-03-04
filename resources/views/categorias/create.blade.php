<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.crearCategoria')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Links a scripts externos-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <!--Link a css y js propio-->
    <link rel="stylesheet" href="{{asset('css/categorias/create.css')}}">
</head>

<body>
    @extends('layouts.app')

    @php
    $languageDirectories = scandir(resource_path('lang'));
    $languages = array_filter($languageDirectories, function ($dir) {
    return !in_array($dir, ['.', '..']) && is_dir(resource_path('lang/' . $dir));
    });
    @endphp

    @section('content')
    <div class="m-4">
        <div class="d-flex align-items-center justify-content-center">
            <div class="row border border-secondary-subtle rounded">
                <div class="icon-service bg-white col-3 col-lg-2 p-0">
                    <!-- Puedes cambiar la imagen según tus necesidades -->
                    <img src="https://i.gyazo.com/e979ec500531fff73e4de0eabd69dc73.png" title="Intert" class="img-icon-service img-fluid">
                </div>
                <div class=" py-2 px-4 col d-flex flex-column align-content-center">
                    <div class="mt-auto"></div>
                    <h3>@lang('messages.createCategoria')</h3>
                    <p>
                        {{__('messages.createCategoriaText')['parrafo1']}}<br />
                        {{__('messages.createCategoriaText')['parrafo2']}}
                    </p>
                    <div class="mb-auto"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-connection-div m-3">
        <div class="p-0">
            <form method="post" id="create-form" action="{{ route('categorias.store', '$categoria->id') }}">
                @csrf
                <div class="d-grid" id="campos">
                    @foreach($languages as $language)
                    <!-- Form group nombre -->
                    <div class="input-field campo">
                        <label for="nom{{$language}}">@lang("messages.nombreCat_$language")*:</label>
                        <input id="nom{{$language}}" name="nom{{$language}}" type="text" class="form-control" value="" required>
                    </div>
                    @endforeach

                    <!-- Form group empresa -->
                    <div class="input-field border border-dark border-opacity-25 rounded" id="empresas">
                        <div class="list-group">
                            <button type="button" class="list-group-item disabled bg-secondary bg-opacity-10"><strong>@lang("messages.empresas"):</strong></button>
                        </div>
                        <div class="list-group" id="catContainer">
                            <button type="button" class="list-group-item list-group-item-action active" value="0" onclick="toggle(this)">--@lang("messages.ninguna")--</button>
                            @foreach($empresas as $empresa)
                            <button type="button" class="list-group-item list-group-item-action" value="{{$empresa->id}}" onclick="toggle(this)">{{$empresa->nombre}}</button>
                            @endforeach
                            <input type="hidden" id="empresa" name="empresa" />
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-primary ms-2 border-dark" value="aceptar" type="submit">
                        <i class='fa-solid fa-check mx-2'></i>@lang('messages.aceptar')
                    </button>
                    <button class="btn btn-secondary ms-2 border-dark" value="cancel" onclick="cancelar()">
                        <i class='fa-solid fa-xmark mx-2'></i>@lang('messages.cancelar')
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function cancelar() {
            window.history.back();
        }

        var activo = document.getElementById("catContainer").getElementsByClassName("active")[0];
        document.documentElement.style.setProperty('--filas', document.getElementById("campos").getElementsByClassName("campo").length);

        function toggle(e) {
            activo.classList.toggle("active");
            e.classList.toggle("active");
            activo = e;
            document.getElementById("empresa").value = e.value;
        }
    </script>
    @endsection

</html>