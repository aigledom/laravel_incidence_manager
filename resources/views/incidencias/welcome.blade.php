<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.gestorIncidencias')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Implementaciones-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer="defer"></script>
    <!--Link a css y js propio-->
    <link rel="stylesheet" href="{{asset('css/incidencias/welcome.css')}}">
    <script type="text/javascript" src="{{asset('js/incidencias/welcome.js')}}"></script>
</head>

<body>
    @extends('layouts.app')
    @section('content')
    <div class="container-fluid p-2 my-4">
        <!-- Lista de incidencias -->
        <div class="mx-auto container-fluid w-100">
            <table class="table table-striped text-center my-3 pt-2 border-dark" id="incidencias-table">
                <thead>
                    <tr>
                        <th class="p-1 m-2 bg-dark" style="width: 15px"></th>
                        <th class="bg-dark text-white text-center align-middle">@lang('messages.nombre')</th>
                        <th class="bg-dark text-white text-center align-middle">@lang('messages.apellidos')</th>
                        <th class="bg-dark text-white text-center align-middle">@lang('messages.dni')</th>
                        <th class="bg-dark text-white text-center align-middle">@lang('messages.telefono')</th>
                        <th class="bg-dark text-white text-center align-middle">@lang('messages.email')</th>
                        <th class="bg-dark text-white text-center align-middle">@lang('messages.categoria')</th>
                        <th class="bg-dark text-white text-center align-middle">@lang('messages.descripcion')</th>
                        <!-- Acciones de incidencias -->
                        <th class="bg-dark p-0 m-0"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incidencias as $incidencia)
                    @php
                    $ruta = route('incidencias.show', $incidencia->id);
                    @endphp
                    <tr data-estado="{{ $incidencia->estado }}" onclick="location.href = '{{$ruta}}'">
                        <td class="m-2 p-1 colorEstado" style="color: transparent">{{ $incidencia->estado }}</td>
                        <td class="align-middle">{{ $incidencia->nombre }}</td>
                        <td class="align-middle">{{ $incidencia->apellidos }}</td>
                        <td class="align-middle">{{ $incidencia->dni }}</td>
                        <td class="align-middle">{{ $incidencia->telefono }}</td>
                        <td class="align-middle">{{ $incidencia->email }}</td>
                        @php
                        $categoria = App\Models\Categoria::find($incidencia->id_cat);
                        @endphp
                        <td class="align-middle">@lang('categorias.'.$categoria->tipo)</td>
                        <td class="align-middle">{{ $incidencia->descripcion }}</td>
                        <!-- Botones de acciones de incidencias -->
                        <td class="align-middle px-0 mx-0">
                            <a class="btn btnOptions border-secondary" href="{{ route('incidencias.show', $incidencia->id) }}">
                                <i class="fa-solid fa-circle-chevron-down"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-info border-dark my-2" id="crear" href="{{ route('incidencias.index') }}">
                            <i class='fa-solid fa-circle-plus mx-2'></i>@lang("messages.addIncidence")
                        </a>
                    </div>
                </tbody>
            </table>
            <div class="input-group me-3" id="estado-group">
                <select id="estado" name="estado" class="form-control" required style="border:1px solid #6c757d">
                    <option value="-1" selected>@lang('messages.ver_todos')</option>
                    @foreach (App\Models\Incidencia::getEstados() as $id_estado => $estado)
                    <option value="{{$id_estado}}">
                        @lang('messages.estado_'.$estado)</option>
                    @endforeach
                </select>
                <button id="filtrar" type="button" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-filter"></i>
                </button>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>