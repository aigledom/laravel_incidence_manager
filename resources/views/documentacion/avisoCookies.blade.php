<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.politica_privacidad')</title>
    <!--Icono de la web-->
    <link rel="icon" href="{{asset('imgs/icono.ico')}}" type="image/x-icon">
</head>

<body>
    @extends('layouts.app')
    @section('content')
    <div class="container my-4">
        <p>@lang('documentacion.avisoCookies')</p>
    </div>
    @endsection
</body>

</html>