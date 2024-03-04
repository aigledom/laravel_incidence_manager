<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.crearEmpresa')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Links a scripts externos-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js"></script>
    <!--Link a css y js propio-->
    <link rel="stylesheet" href="{{asset('css/empresas/create.css')}}">
</head>

<body class="bg-light-subtle">
    @extends('layouts.app')

    @section('content')
    <div class="m-4">
        <div class="d-flex align-items-center justify-content-center">
            <div class="row border border-secondary-subtle rounded">
                <div class="icon-service bg-white col-3 col-lg-2 p-0">
                    <img src="https://i.gyazo.com/e979ec500531fff73e4de0eabd69dc73.png" title="Intert" class="img-icon-service img-fluid">
                </div>
                <div class=" py-2 px-4 col d-flex flex-column align-content-center">
                    <div class="mt-auto"></div>
                    <h3>@lang('messages.crearEmpresas')</h3>
                    <p>
                        {{__('messages.createEmpresaText')['parrafo1']}}<br/>
                        {{__('messages.createEmpresaText')['parrafo2']}}<br/>
                        {{__('messages.createEmpresaText')['parrafo3']}}
                    </p>
                    <div class="mb-auto"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-connection-div m-3">
        <div class="p-0">
            <form method="post" id="create-form" action="{{ route('empresas.store', '$empresa->id') }}">
                @csrf
                <div class="d-grid" id="campos">
                    <!-- Form group nombre -->
                    <div class="input-field ">
                        <label for="nombre">@lang("messages.nombre")*:</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" value="" required>
                    </div>
                    <!-- Form group direccion -->
                    <div class="input-field ">
                        <label for="direccion">@lang("messages.direccion"):</label>
                        <input id="direccion" name="direccion" type="text" class="form-control" value="">
                    </div>
                    <!-- Form group cif -->
                    <div class="input-field ">
                        <label for="cif">CIF*:</label>
                        <input id="cif" name="cif" type="text" class="form-control text-uppercase" pattern="([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])" value="" required>
                    </div>
                    <!-- Form group mail -->
                    <div class="input-field ">
                        <label for="mail">@lang("messages.email")*:</label>
                        <input id="mail" name="mail" type="email" class="form-control" value="" required>
                    </div>
                    <!-- Form group telefono -->
                    <div class="input-field ">
                        <label for="telefono">@lang("messages.telefono"):</label>
                        <input id="telefono" name="telefono" type="tel" class="form-control" value="">
                    </div>
                    <!-- Form group categorias -->
                    <div class="input-field ">
                        <div class="list-group">
                            <button type="button" class="list-group-item disabled bg-secondary bg-opacity-10"><strong>@lang("messages.categorias"):</strong></button>
                        </div>
                        <div class="list-group" id="catContainer">
                            @foreach($categorias as $categoria)
                            <button type="button" class="list-group-item list-group-item-action" value="{{$categoria->id}}" onclick="toggle(this)">@lang("categorias.$categoria->tipo")</button>
                            @endforeach
                            <input type="hidden" id="categorias" name="categorias" />
                        </div>
                    </div>
                    <!-- Form group actividad -->
                    <div class="input-field">
                        <p class="mb-0 ms-3" for="actividad">@lang("messages.actividad"):</p>
                        <textarea name="actividad" id="actividad" class="form-control" cols="100" rows="4"></textarea>
                    </div>
                </div>
                <!--Botones acciones-->
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

        function toggle(e) {
            e.classList.toggle("active");
            var categorias = document.getElementById("categorias");
            var catValues = [];
            if (categorias.value !== "") {
                catValues = categorias.value.split(',');
            }
            catValues.push(e.value);
            categorias.value = catValues;
        }
    </script>
    @endsection

</html>