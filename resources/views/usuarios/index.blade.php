<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang("messages.panelUsuarios")</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
    <!-- Implementaciones -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer="defer"></script>
    <!-- Link a CSS y JS propios -->
    <script type="text/javascript" src="{{ asset('js/usuarios/index.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/usuarios/index.css') }}">
</head>

<body>
    @extends('layouts.app')
    @section('content')
    <div class="container my-4">
        <!-- Lista de usuarios -->
        <table class="table table-bordered table-striped text-center my-3 pt-2" id="usuarios-table">
            <thead class="thead-dark">
                <tr>
                    <th class="bg-dark text-center text-white align-middle">ID</th>
                    <th class="bg-dark text-center text-white align-middle">@lang("messages.nombre")</th>
                    <th class="bg-dark text-center text-white align-middle">@lang("messages.telefono")</th>
                    <th class="bg-dark text-center text-white align-middle">@lang("messages.email")</th>
                    <th class="bg-dark text-center text-white align-middle">@lang("messages.rol")</th>
                    <th class="bg-dark text-center text-white align-middle">@lang("messages.empresa")</th>
                    <th class="bg-dark text-center text-white align-middle">@lang("messages.acciones")</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                @php
                $rutaEditar = route('usuarios.edit', $usuario->id);
                $rutaBorrar = route('usuarios.destroy', $usuario->id);
                @endphp
                <tr>
                    <td class="text-center align-middle">{{ $usuario->id }}</td>
                    <td class="text-center align-middle">{{ $usuario->name }}</td>
                    <td class="text-center align-middle">{{ $usuario->telefono }}</td>
                    <td class="text-center align-middle">{{ $usuario->email }}</td>
                    <td class="text-center align-middle">@lang("messages.".$usuario->rol)</td>
                    <td class="text-center align-middle">
                        @php
                        $empresa = $empresas->where('id', $usuario->id_empresa)->first();
                        @endphp
                        @if($empresa)
                        {{ $empresa->nombre }}
                        @else
                        @lang("messages.sinEmpresa")
                        @endif
                    </td>
                    <!-- Botones de acciones de usuarios -->
                    <td class="text-center align-middle">
                        <article class="list-item" data-list-item-key="1">
                            <section data-listview-item-buttons="">
                                <a class="btn btn-primary border-dark" href="{{ $rutaEditar }}">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button type="button" class="btn btn-danger border-dark" data-bs-toggle="modal" data-bs-target="#accionesModal-{{ $usuario->id }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </section>
                        </article>
                    </td>
                </tr>
                <!-- Modal borrar usuario -->
                <div class="modal fade" id="accionesModal-{{ $usuario->id }}" tabindex="-1" aria-labelledby="titleModalAcciones-{{ $usuario->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="titleModalAcciones-{{ $usuario->id }}">@lang("messages.eliminarUsuario")</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>@lang("messages.eliminarUsuarioMsg")</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-secondary border-dark" data-bs-dismiss="modal">
                                    <i class="fa-solid fa-xmark mx-2"></i>@lang('messages.cancelar')
                                </button>
                                <form action="{{ $rutaBorrar }}" method="POST">
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
                    <a class="btn btn-info border-dark my-2" id="crear" href="{{ route('usuarios.create') }}">
                        <i class='fa-solid fa-circle-plus mx-2'></i>@lang("messages.addUsers")
                    </a>
                </div>
            </tbody>
        </table>
    </div>

    @endsection
</body>

</html>