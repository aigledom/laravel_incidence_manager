<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.panelCategorias')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!--Implementaciones-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer="defer"></script>
    <!--Link a css y js propio-->
    <script type="text/javascript" src="{{asset('js/categorias/index.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/categorias/index.css')}}">
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container p-2 my-4">
        <div class="row w-100">
            <!-- Columna 1 para la imagen -->
            <div class="col-4 d-flex justify-content-center align-items-center d-none d-xl-block my-auto" id="imgCategoria">
                <img src="{{asset('imgs/categorias.png')}}" alt="Categorías" class="img-fluid">
            </div>
            <!-- Lista de categorias -->
            <div class="col-12 col-xl-8 px-4">
                <div class="table-responsive rounded mx-auto">
                    <table class="table table-bordered table-striped text-center my-3 pt-2" id="categorias-table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="bg-dark text-center text-white align-middle">ID</th>
                                <th class="bg-dark text-center text-white align-middle">@lang('messages.categoria')</th>
                                <th class="bg-dark text-center text-white align-middle">@lang('messages.empresa')</th>
                                <th class="bg-dark text-center text-white align-middle">@lang('messages.acciones')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $categoria)
                            @php
                            $ruta = route('categorias.edit',$categoria->id);
                            @endphp
                            <tr>
                                <td class="text-center align-middle">{{ $categoria->id }}</td>
                                <td class="text-center align-middle">
                                    <a class="text-decoration-none text-black" href={{$ruta}}>@lang("categorias.$categoria->tipo")<a>
                                </td>
                                <td class="align-middle">
                                    @if ($empresa = $empresas->where('id', $categoria->id_empresa)->first())
                                    <a class="text-decoration-none text-black" href="{{ route('empresas.edit', $empresa->id) }}">{{$empresa->nombre}} <a>
                                            @endif
                                </td>
                                <!-- Botones de acciones de categorias -->
                                <td class="text-center align-middle">
                                    <article class="list-item" data-list-item-key="1">
                                        <section data-listview-item-buttons="">
                                            <a class="btn btn-primary border-dark" href="{{ route('categorias.edit', $categoria->id) }}">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger border-dark" data-bs-toggle="modal" data-bs-target="#accionesModal-{{ $categoria->id }}">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </section>
                                    </article>
                                </td>
                            </tr>
                            <!-- Modal borrar categoria-->
                            <div class="modal fade" id="accionesModal-{{ $categoria->id }}" tabindex="-1" aria-labelledby="titleModalAcciones-{{ $categoria->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="titleModalAcciones-{{ $categoria->id }}">
                                                @lang('messages.delete_categoria')</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>@lang('messages.delete_categoria_confirm')</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary border-dark" data-bs-dismiss="modal">
                                                <i class="fa-solid fa-xmark mx-2"></i>@lang('messages.cancelar')
                                            </button>
                                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
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
                                <a class="btn btn-info border-dark my-2" id="crear" href="{{route('categorias.create')}}">
                                    <i class='fa-solid fa-circle-plus mx-2'></i>@lang('messages.addCategorias')
                                </a>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>