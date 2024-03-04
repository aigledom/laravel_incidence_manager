<?php

namespace App\Http\Controllers;

use App\Models\Consultas;
use Illuminate\Http\Request;

class OpcionesController extends Controller
{
    //Muestra el panel de control del administrador
    public function index()
    {
        //Obtiene los campos a modificar
        $camposIncidencias = Consultas::getCamposIncidencia();
        //Se obtiene los campos que actualmente son nulos en la base de datos para marcar
        //automáticamente los checkboxes en la vista
        $camposNulos = Consultas::getCamposNulos($camposIncidencias);
        //Se muestra la vista del panel de administrador
        return view('opciones.panel', compact('camposIncidencias', 'camposNulos'));
    }

    public function updateCampos(Request $request)
    {
        Consultas::updateCampos($camposNulos = $request->input('camposNulos'));
        //Muestra la vista del panel actualizado
        $camposIncidencias = Consultas::getCamposIncidencia();
        $camposNulos = Consultas::getCamposNulos($camposIncidencias);
        $actualizado = true;
        return view('opciones.panel', compact('camposIncidencias', 'camposNulos', 'actualizado'));
    }
}
