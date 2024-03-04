<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.show_incidencia')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Links a css y js propio-->
    <link rel="stylesheet" href="{{asset('css/incidencias/incidencia.css')}}">
    <link rel="stylesheet" href="{{asset('css/incidencias/show.css')}}">
    <script type="text/javascript" src="{{asset('js/incidencias/incidencia.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/components/thumbnailsImg.js')}}"></script>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-around">
            <!-- Columna para la tarjeta -->
            <div class="col-md-6 my-4 p-0">
                <div class="card text-center border-secondary">
                    <!--Cabecera con nombre y apellidos-->
                    <div class="card-header">
                        <h4 class="card-title text-white p-2">{{ $incidencia->nombre }} {{ $incidencia->apellidos }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <!--Card item mapa-->
                            <x-map pagina="show" ubicacion="{{$incidencia->ubicacion}}"></x-map>
                            <span id="msgMapError" hidden>@lang("messages.empty_map")</span>
                            <!--Card item categoría-->
                            @if(!empty($incidencia->id_cat))
                            @php
                            $categoria = App\Models\Categoria::find($incidencia->id_cat);
                            @endphp
                            <li class="list-group-item"><strong>@lang('messages.categoria'):</strong> @lang('categorias.'.$categoria->tipo)</li>
                            @else
                            <li class="list-group-item"><strong>@lang('messages.categoria'):</strong> @lang('messages.no_disponible')</li>
                            @endif
                            <!--Card item descripción-->
                            @if(!empty($incidencia->descripcion))
                            <li class="list-group-item"><strong>@lang('messages.descripcion'):</strong> {{ $incidencia->descripcion }}</li>
                            @else
                            <li class="list-group-item"><strong>@lang('messages.descripcion'):</strong> @lang('messages.no_disponible')</li>
                            @endif
                        </ul>
                        <!-- Datos ocultos -->
                        <div id="moreData" class="collapse">
                            <ul class="list-group list-group-flush">
                                <!--Card item DNI-->
                                @if(!empty($incidencia->dni))
                                <li class="list-group-item"><strong>@lang('messages.dni'):</strong> {{ $incidencia->dni }}</li>
                                @else
                                <li class="list-group-item"><strong>@lang('messages.dni'):</strong> @lang('messages.no_disponible')</li>
                                @endif
                                <!--Card item teléfono-->
                                @if(!empty($incidencia->telefono))
                                <li class="list-group-item"><strong>@lang('messages.telefono'):</strong> {{ $incidencia->telefono }}</li>
                                @else
                                <li class="list-group-item"><strong>@lang('messages.telefono'):</strong> @lang('messages.no_disponible')</li>
                                @endif
                                <!--Card item email-->
                                @if(!empty($incidencia->email))
                                <li class="list-group-item"><strong>@lang('messages.email'):</strong> {{ $incidencia->email }}</li>
                                @else
                                <li class="list-group-item"><strong>@lang('messages.email'):</strong> @lang('messages.no_disponible')</li>
                                @endif
                                <!--Card item fecha resolución-->
                                @if(!empty($incidencia->fecha_resolucion))
                                <li class="list-group-item"><strong>@lang('messages.fecha_resolucion'):</strong> {{ date("d/m/Y", strtotime($incidencia->fecha_resolucion)) }}</li>
                                @else
                                <li class="list-group-item"><strong>@lang('messages.fecha_resolucion'):</strong> @lang('messages.no_disponible')</li>
                                @endif
                            </ul>
                        </div>
                        <!-- Botón para mostrar más datos -->
                        <button id="toggleButton" class="btn btn-success rounded-circle border-dark" data-bs-toggle="collapse" data-bs-target="#moreData">
                            <i class="fas fa-plus"></i>
                        </button>
                        <!--Formulario de estado-->
                        <form class="list-group-item mt-2" id="form_estado" name="form_estado" action="{{ route('incidencias.update', $incidencia->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mt-1">
                                <div class="col-sm-3">
                                    <strong><label class="control-label" for="estado">@lang('messages.estado')*:</label></strong>
                                </div>
                                <div class="input-group col-sm-9">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-mail">
                                            <i class="fa-solid fa-screwdriver-wrench"></i>
                                        </span>
                                    </div>
                                    <select id="estado" name="estado" class="form-control fw-bolder" required>
                                        @foreach (App\Models\Incidencia::getEstados() as $id_estado => $estado)
                                        <option value="{{$id_estado}}" {{($id_estado == $incidencia->estado)?"selected":""}}>
                                            @lang('messages.estado_'.$estado)</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--Card footer con fecha creación-->
                    <div class="card-footer text-muted">
                        @lang('messages.fecha_creacion'):<br> {{ date("d/m/Y", strtotime($incidencia->fecha_creacion)) }}
                    </div>
                </div>
            </div>
            <div class="row align-items-center col-md-6 my-4">
                <!-- Carrusel de imágenes-->
                <div id="contCarousel" class="pt-4 border border-secondary rounded">
                    <div id="imageCarousel" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-inner h-100">
                            @if (!is_null($incidencia->adjuntar_imagen))
                            @php
                            $imagenes = json_decode($incidencia->adjuntar_imagen, true);
                            $primera = true;
                            @endphp
                            @foreach ($imagenes as $imagen)
                            <div class="carousel-item {{$primera?'active':''}} align-items-center w-100 h-100">
                                <img alt="Imagen" class="img-fluid mx-auto w-100 h-100 rounded border border-secondary-subtle" src="{{ asset('storage/uploads/' . $imagen) }}">
                            </div>
                            {{$primera = false}}
                            @endforeach
                            @else
                            <!-- Imagen genérica cuando no hay imagen adjunta -->
                            <div class="carousel-item active d-flex align-items-center">
                                <img alt="Imagen Genérica" class="img-fluid mx-auto rounded border border-secondary-subtle" src="{{ asset('https://www.unex.es/conoce-la-uex/centros/epcc/archivos/imagenes/epcc-iconos/ICONO%20INCIDENCIAS.png/image_preview') }}">
                            </div>
                            @endif
                        </div>
                        <!--Controlador anterior-->
                        <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                            <span class="p-1 rounded-circle bg-dark d-flex justify-content-center align-items-center" aria-hidden="true">
                                <span class="carousel-control-prev-icon"></span>
                            </span>
                        </button>
                        <!--Controlador siguiente-->
                        <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                            <span class="p-1 rounded-circle bg-dark d-flex justify-content-center align-items-center" aria-hidden="true">
                                <span class="carousel-control-next-icon"></span>
                            </span>
                        </button>
                    </div>
                    <div class="d-flex justify-content-center py-3 rounded row border border-secondary-subtle" id="miniaturaContainer"></div>
                    <!--Guarda información de las imágenes para rescatarla en js-->
                    @if (!is_null($incidencia->adjuntar_imagen))
                    <div id="imagenes-data" data-imagenes='@json($imagenes)'></div>
                    @endif
                </div>
            </div>
            <div id="btnGroup" class="mt-4 text-center flex-md-column mt-md-4">
                <!--Boton guardar estado-->
                <button type="submit" form="form_estado" class="btn btn-primary mx-2 px-3 py-2 border-dark"><i class="fa-solid fa-save mx-2"></i>@lang('messages.guardar')</button>
                <!--Enlace editar incidencia-->
                <a href="{{ route('incidencias.edit', $incidencia->id) }}" class="btn btn-secondary mx-2 px-3 py-2 border-dark"><i class="fa-solid fa-eye mx-2"></i>@lang('messages.edit')</a>
                <!--Boton borrar incidencia-->
                <button type="button" class="btn btn-danger mx-2 px-3 py-2 border-dark" data-bs-toggle="modal" data-bs-target="#accionesModal-{{ $incidencia->id }}">
                    <i class="fa-solid fa-trash mx-2"></i>@lang('messages.delete')
                </button>
            </div>

            <!-- Modal borrar incidencia-->
            <div class="modal fade" id="accionesModal-{{ $incidencia->id }}" tabindex="-1" aria-labelledby="titleModalAcciones-{{ $incidencia->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="titleModalAcciones-{{ $incidencia->id }}">
                                @lang('messages.delete_incidencia')</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>@lang('messages.delete_confirm')</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary border-dark" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark mx-2"></i>@lang('messages.cancelar')
                            </button>
                            <form action="{{ route('incidencias.destroy', $incidencia->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary border-dark">
                                    <i class="fa-solid fa-check mx-2"></i>@lang('messages.aceptar')
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>