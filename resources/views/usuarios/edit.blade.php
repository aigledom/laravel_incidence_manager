<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang("messages.editarUsuario")</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!-- Link a CSS propio -->
    <link rel="stylesheet" href="{{ asset('css/usuarios/edit.css') }}">
    <!-- Recoge en una variable si el rol actual es duplicado o no -->
    <script type="text/javascript">
        var emailDuplicado = "<?php echo isset($emailDuplicado) ? $emailDuplicado : null; ?>";
    </script>
    <script type="text/javascript" src="{{ asset('js/usuarios/edit.js') }}"></script>
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
    <div class="container">
        <div class="form-container">
            <div class="section-header text-center w-100">
                <h1 class="primary-heading my-4">@lang("messages.editarUsuario")<span class="fullstop">.</span></h1>
            </div>
            <form method="post" id="edit-form" action="{{ route('usuarios.update', $usuario->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-input">
                    <div class="name-input">
                        <input type="text" name="name" id="name" value="{{ $usuario->name }}" placeholder="@lang('messages.username')" required />
                        <input type="number" name="telefono" id="telefono" value="{{ $usuario->telefono }}" placeholder="@lang('messages.telefono')" />
                    </div>
                    <input type="email" name="email" id="email" placeholder="@lang('messages.email')" value="{{ $usuario->email }}" required />
                    <!--Campo select con roles de usuario-->
                    <div class="d-flex align-items-center">
                        <label for="rol" class="form-label mb-0 me-3 col-2">@lang("messages.rol"):</label>
                        <select class="form-select" name="rol" id="rol">
                            @if($usuario->rol=="sinRol")
                            <option value="sinRol" selected>sinRol</option>
                            @endif
                            @foreach($roles as $rol)
                            <option value="{{lcfirst($rol->name)}}" {{lcfirst($rol->name)==$usuario->rol?"selected":""}}>{{$rol->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--Campo select con nombres de empresa-->
                    <div class="d-flex align-items-center">
                        <label for="empresa" class="form-label mb-0 me-3 col-2">@lang("messages.empresa"):</label>
                        <select class="form-select" name="empresa">
                            @if (!$empresas->isEmpty())
                            <option value="">@lang("messages.sinEmpresa")</option>
                            @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                            @endforeach
                            @else
                            <option value="">@lang("messages.noEmpresas")</option>
                            @endif
                        </select>
                    </div>
                    <div class="btn-input mt-3">
                        <button id="btnVolver" type="button" class="secondary-btn">
                            <i class="fa-solid fa-xmark mx-2"></i>@lang("messages.volver")
                        </button>
                        <button type="submit" class="primary-btn">
                            <i class="fa-solid fa-arrows-rotate mx-2"></i>@lang("messages.actualizar")
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="side-panel">
            <div class="background"></div>
        </div>
    </div>
    <!-- Modal para el email duplicado -->
    <div class="modal fade" id="emailDuplicadoModal" tabindex="-1" aria-labelledby="titleEmailDuplicadoModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="titleEmailDuplicadoModal">@lang("messages.emailDuplicado")</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>@lang("messages.emailDuplicadoMsg")</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-subtle py-2 ps-3 border-dark" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> @lang("messages.cerrar")Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>