<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.gestionCampos')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container p-2 mt-4">
        <div class="row w-100">
            <h1 class="text-center mt-2 mb-4">@lang("messages.camposIncidencias")</h1>
            <!-- Columna 1 para la imagen -->
            <div class="col-4 d-flex justify-content-center align-items-center d-none d-xl-block">
                <img src="{{asset('imgs/transferencia-de-datos.png')}}" alt="Transferencia de datos" class="img-fluid">
            </div>
            <!-- Columna 2 para el formulario con los campos modificables para poder ser nulos-->
            <div class="col-12 col-xl-8 p-4">
                <form method="POST" action="{{ route('opciones.updateCampos') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive rounded">
                        <table class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col" class="bg-dark text-white align-middle">#</th>
                                    <th scope="col" class="bg-dark text-white align-middle">@lang("messages.campo")</th>
                                    <th scope="col" class="bg-dark text-white align-middle">@lang("messages.nullable")</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($camposIncidencias as $index => $campo)
                                <tr>
                                    <th scope="row">{{ $index }}</th>
                                    <td>@lang("messages.".$campo)</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input border-secondary" type="checkbox" name="camposNulos[]" value="{{ $campo }}" @if(in_array($campo, $camposNulos)) checked @endif>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <!-- Botón de actualización -->
                        <button type="submit" class="btn btn-primary border-dark me-3">
                            <i class="fa-solid fa-refresh mx-2"></i>@lang("messages.actualizar")
                        </button>
                    </div>
                </form>
                <!--Modal que se muestra si se ha actualizado-->
                <div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="titleModalExito" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="titleModalExito">@lang("messages.actExitosa")</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @lang("messages.camposActCorrec")
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary border-dark" data-bs-dismiss="modal">
                                    <i class="fa-solid fa-close mx-2"></i>@lang("messages.cerrar")
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>