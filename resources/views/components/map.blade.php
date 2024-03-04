<div x-data="map()">
    <div id="map" x-ref="map" class="border border-slate-300 rounded-md shadow-lg">
    </div>
</div>
@php
IF(isset($ubicacion)){
$ubicacion = preg_replace("/&quot;/",'"', $ubicacion);}
@endphp
<script>
    var iconUrl = "{{ asset('imgs/marcador.png') }}";
    var pagina = "{{ $pagina }}";
    if ("{{($ubicacion)}}") {
        var coords = {
            lat: Number("{{($ubicacion)?json_decode('{'.$ubicacion.'}')->y:''}}"),
            lng: Number("{{($ubicacion)?json_decode('{'.$ubicacion.'}')->x:''}}")
        };
    }
</script>
@once
@push('styles')
@vite(['resources/css/components/map.css'])
@endpush
@push('scripts')
@if(env('GOOGLE_MAP_KEY'))
@include('components.mapGoogle')
@else
@vite(['resources/js/components/map.js'])
@endif
@endpush
@endonce