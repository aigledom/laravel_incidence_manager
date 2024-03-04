<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.panelEmpresas')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Implementaciones-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer="defer"></script>
    <!--Link a css y js propio-->
    <script type="text/javascript" src="{{asset('js/empresas/index.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/empresas/index.css')}}">
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container p-2 my-4">

        <!-- Lista de categorias -->
        <div class="px-4">
            <div class="table-responsive rounded mx-auto">
                <table class="table table-bordered table-striped text-center my-3 pt-2" id="empresas-table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="bg-dark text-center text-white align-middle">ID</th>
                            <th class="bg-dark text-center text-white align-middle">@lang('messages.nombre')</th>
                            <th class="bg-dark text-center text-white align-middle">CIF</th>
                            <th class="bg-dark text-center text-white align-middle">@lang('messages.email')</th>
                            <th class="bg-dark text-center text-white align-middle">@lang('messages.categorias')</th>
                            <th class="bg-dark text-center text-white align-middle">@lang('messages.acciones')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empresas as $empresa)
                        @php
                        $ruta = route('empresas.edit',$empresa->id);
                        $colores = ["bg-primary","bg-secondary","bg-success","bg-danger","bg-warning","bg-info","bg-dark"];
                        $opacidades = ["","","bg-opacity-75","bg-opacity-50"]
                        @endphp
                        <tr>
                            <td class="text-center align-middle">{{ $empresa->id }}</td>
                            <td class="text-center align-middle"><a class="text-decoration-none text-black" href={{$ruta}}>{{ $empresa->nombre }}<a></td>
                            <td class="text-center align-middle">{{$empresa->cif}}</td>
                            <td class="text-center align-middle">{{$empresa->mail}}</td>
                            <td class="text-center align-middle">
                                @foreach($categorias as $categoria)
                                @if($categoria->id_empresa == $empresa->id)
                                <span class="link badge rounded-pill {{$colores[rand(0,count($colores)-1)]}} {{$opacidades[rand(0,count($opacidades)-1)]}}">
                                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="link-light link-underline-opacity-0">@lang("categorias.".$categoria->tipo)</a>
                                </span>
                                @endif
                                @endforeach
                            </td>
                            <!-- Botones de acciones de empresas -->
                            <td class="text-center align-middle">
                                <article class="list-item" data-list-item-key="1">
                                    <section data-listview-item-buttons="">
                                        <a class="btn btn-primary border-dark" href="{{ route('empresas.edit',$empresa->id) }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger border-dark" data-bs-toggle="modal" data-bs-target="#accionesModal-{{ $empresa->id }}">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </section>
                                </article>
                            </td>
                        </tr>
                        <!-- Modal borrar empresa-->
                        <div class="modal fade" id="accionesModal-{{ $empresa->id }}" tabindex="-1" aria-labelledby="titleModalAcciones-{{ $empresa->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="titleModalAcciones-{{ $empresa->id }}">
                                            @lang('messages.delete_empresa')</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-danger fw-bold">@lang('messages.delete_empresa_usuarios')</p>
                                        <p>@lang('messages.delete_empresa_confirm')</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-secondary border-dark" data-bs-dismiss="modal">
                                            <i class="fa-solid fa-xmark mx-2"></i>@lang('messages.cancelar')
                                        </button>
                                        <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
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
                        @endforeach
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-info border-dark my-2" id="crear" href="{{route('empresas.create')}}">
                                <i class='fa-solid fa-circle-plus mx-2'></i>@lang("messages.addCompany")
                            </a>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>