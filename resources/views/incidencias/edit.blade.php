<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.edit_incidencia')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Link a css propio-->
    <link rel="stylesheet" href="{{asset('css/incidencias/incidencia.css')}}">
</head>

<body>
    @extends('layouts.app')
    @section('content')
    <div class="container edit ">
        <div class="row">
            <div class="row mx-auto">
                <!--Parte lateral form-->
                <div id="form-tagline" class="col-md-4">
                    <div id="form-header" class="col-12 mb-4">
                        <h1 id="title">@lang('messages.edit_incidencia_title')<br><i class="fa-regular fa-pen-to-square my-2"></i></h1>
                    </div>
                    <div class="text-center">
                        <h3>@lang('messages.pregunta_error')</h3>
                        <p id="description" class="lead">@lang('messages.apreciamos_aporte')</p>
                    </div>
                </div>
                <!--Contenido del form-->
                <div id="form-content" class="col-md-8">
                    <form method="POST" action="{{ route('incidencias.update', $incidencia->id) }}" enctype="multipart/form-data" onsubmit="return verificarUbicacion()">
                        @csrf
                        @method('PUT')
                        <!--Form group nombre-->
                        <div class="form-group row border border-light-subtle rounded py-2">
                            <div class="col-sm-3 d-flex align-items-center ps-3">
                                <label class="control-label" for="nombre">@lang('messages.nombre'){{(in_array('nombre', $camposNulos))? "":"*" }}:</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-name">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                    <input id="nombre" type="text" class="form-control" placeholder="@lang('messages.placeholder_nombre')" name="nombre" {{(in_array('nombre', $camposNulos))? "":"required" }} value="{{ $incidencia->nombre ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <!--Form group apellidos-->
                        <div class="form-group row mt-3 border border-light-subtle rounded py-2">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label class="control-label" for="apellidos">@lang('messages.apellidos'){{(in_array('apellidos', $camposNulos))? "":"*" }}:</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-name">
                                            <i class="fa fa-clipboard-user"></i>
                                        </span>
                                    </div>
                                    <input id="apellidos" type="text" class="form-control" placeholder="@lang('messages.placeholder_apellidos')" name="apellidos" {{(in_array('apellidos', $camposNulos))? "":"required" }} value="{{ $incidencia->apellidos ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <!--Form group dni-->
                        <div class="form-group row mt-3 border border-light-subtle rounded py-2">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label class="control-label" for="dni">@lang('messages.dni'){{(in_array('dni', $camposNulos))? "":"*" }}:</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-name">
                                            <i class="fa fa-id-card"></i>
                                        </span>
                                    </div>
                                    <input id="dni" type="text" class="form-control" placeholder="@lang('messages.placeholder_dni')" name="dni" pattern="[0-9]{8}[A-Za-z]" {{(in_array('dni', $camposNulos))? "":"required" }} value="{{ $incidencia->dni ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <!--Form group telefono-->
                        <div class="form-group row mt-3 border border-light-subtle rounded py-2">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label class="control-label" for="telefono">@lang('messages.telefono'){{(in_array('telefono', $camposNulos))? "":"*" }}:</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-name">
                                            <i class="fa fa-mobile-screen"></i>
                                        </span>
                                    </div>
                                    <input id="telefono" type="text" pattern="[0-9]{9}" class="form-control" placeholder="@lang('messages.placeholder_telefono')" name="telefono" {{(in_array('telefono', $camposNulos))? "":"required" }} value="{{ $incidencia->telefono ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <!--Form group email-->
                        <div class="form-group row mt-3 border border-light-subtle rounded py-2">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label class="control-label" for="email">@lang('messages.email'){{(in_array('email', $camposNulos))? "":"*" }}:</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-name">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" id="email" placeholder="@lang('messages.placeholder_email')" name="email" {{(in_array('email', $camposNulos))? "":"required" }} value="{{ $incidencia->email ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <!--Form group adjuntar imagenes-->
                        <div class="form-group row mt-3 border border-light-subtle rounded py-2">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label class="control-label" for="adjuntar_imagen">@lang('messages.adjuntar_imagen'){{(in_array('adjuntar_imagen', $camposNulos))? "":"*" }}:</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-name">
                                            <i class="fa fa-image"></i>
                                        </span>
                                    </div>
                                    <input accept="image/*" type="file" multiple class="form-control" id="adjuntar_imagen" name="adjuntar_imagen[]" {{(in_array('adjuntar_imagen', $camposNulos))? "":"required" }}>
                                </div>
                            </div>
                        </div>
                        <!--Form group categoria-->
                        <div class="form-group row mt-3 border border-light-subtle rounded py-2">
                            <div class="col-sm-3 d-flex align-items-center ps-3">
                                <label class="control-label" for="categoria">@lang('messages.categoria'):</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-name">
                                            <i class="fa-solid fa-cubes"></i>
                                        </span>
                                    </div>
                                    <select id="id_cat" name="id_cat" class="form-control" required value="{{ $incidencia->id_cat ?? '' }}">
                                        @foreach ($categorias as $categoria)
                                        <option value="{{$categoria->id}}" {{$incidencia->id_cat ==  $categoria->id?'selected':''}}>@lang('categorias.'.$categoria->tipo)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--Form group descripcion-->
                        <div class="form-group row mt-3 border border-light-subtle rounded py-2">
                            <div class="col-sm-3 d-flex align-items-center">
                                <label class="control-label" for="descripcion">@lang('messages.descripcion'){{(in_array('descripcion', $camposNulos))? "":"*" }}:</label>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-name" style="height: 7rem">
                                            <i class="fa fa-square-poll-horizontal"></i>
                                        </span>
                                    </div>
                                    <textarea type="text" rows="4" style="resize: none;" class="form-control" id="descripcion" name="descripcion" {{(in_array('descripcion', $camposNulos))? "":"required" }}>{{ $incidencia->descripcion ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!--Form group mapa-->
                        <div class="mt-2">
                            <x-map pagina="edit" ubicacion="{{$incidencia->ubicacion}}"></x-map>
                        </div>
                        <!--Form group estado-->
                        <input type="hidden" name="estado" value={{ $incidencia->estado }}>
                        <!--Form group ubicacion-->
                        <input id="ubicacion" type="hidden" name="ubicacion" value="{{$incidencia->ubicacion??''}}" {{(in_array('ubicacion', $camposNulos))? "":"required" }}>
                        <!--Form group politicas-->
                        <div class="form-group row mt-3 py-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="politicas" name="politicas" required checked disabled>
                                <label class="form-check-label" for="politicas">
                                    <a href="{{ route('politica_privacidad') }}">
                                        @lang('messages.acepto_politicas')
                                    </a>
                                </label>
                            </div>
                        </div>
                        <!--Form group btn guardar-->
                        <div class="form-group row mt-3">
                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-info py-2 ps-3 border-dark">
                                    <i class="fas fa-save mx-1"></i>@lang('messages.guardar')
                                </button>
                            </div>
                        </div>
                        <!--Modal captcha verificación captcha-->
                        <div class="modal fade" id="modalError" tabindex="-1" aria-labelledby="titlemodalError" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="titlemodalError"></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="bodyMessage"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary-subtle py-2 ps-3 border-dark" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-1"></i> @lang("messages.cerrar")
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="titleModalExito" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="titleModalExito">@lang("messages.creacionExitosa")</h1>
                                    </div>
                                    <div class="modal-body">
                                        @lang("messages.creacionExitosaMsg")
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-danger border-dark" {{(auth()->check())?"href=".route('incidencias.welcome'):'data-bs-dismiss=modal'}}>
                                            <i class="fa-solid fa-close mx-2"></i>@lang("messages.cerrar")
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        //Código para verificar ubicación
        function verificarUbicacion() {
            var mensajeError = "";
            if (document.getElementById("ubicacion").attributes.getNamedItem("required") && (document.getElementById("ubicacion").value == "")) {
                mensajeError += "{{__('messages.faltaUbicacion')}} <br>";
            }
            if (document.getElementById("dni").attributes.getNamedItem("required") || document.getElementById("dni").value != "") {
                if ((!ValidateSpanishID(document.getElementById("dni").value.toUpperCase()).valid)) {
                    mensajeError += "{{__('messages.errorDNI')}}";
                }
            }
            console.log(mensajeError);
            if (mensajeError != "") {
                $('#titlemodalError').text("{{__('messages.faltanCampos')}}");
                $('#captchaMessage').html(mensajeError);
                $('#modalError').modal('show');
                return false;
            }
            return true;
        }
    </script>
    @endsection
</body>