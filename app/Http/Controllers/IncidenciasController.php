<?php

namespace App\Http\Controllers;

use App\Mail\MailAvisoIncidencia;
use App\Models\Categoria;
use App\Models\Consultas;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class IncidenciasController extends Controller
{
    public function index()
    {
        return $this->create();
    }

    public function create()
    {
        // Carga la página de crear incidencias y se envían los tipos de categoría
        $categorias = Categoria::where('disabled', false)->get();
        $camposNulos = Consultas::getCamposNulos(Consultas::getCamposIncidencia());
        return view('incidencias.create', compact('camposNulos', 'categorias'));
    }

    public function store(Request $request)
    {
        // Recoge los datos y crea una nueva incidencia
        // Recorre las imagenes subidas para almacenar sus nombres como JSON
        $datos = $this->agregarImagenes($request);
        $incidencia =Incidencia::create($datos);
        $incidencia = Incidencia::find($incidencia->id);
        $usuarios = Consultas::getUsuariosIncidencia($request->id_cat);
        $nombreCategoria = Lang::get('categorias.' . Categoria::find($incidencia->id_cat)->tipo, [], "es");
        // Mandar mail tras crear una incidencia
        $usuarios->each(function ($user) use ($incidencia, $nombreCategoria) {
            Mail::to($user->email)->send(new MailAvisoIncidencia($user->name, $incidencia, $nombreCategoria));
        });
        if (auth()->check()) {
            return redirect()->route('incidencias.welcome');
        } else {
            return view('incidencias.create', ['camposNulos' => Consultas::getCamposNulos(Consultas::getCamposIncidencia()), 'categorias' => Categoria::all(), 'actualizado' => true]);
        }
    }

    public function welcome()
    {
        // Muestra el panel de inicio
        $nivel = Consultas::getNivel();
        if ($nivel >= 2) {
            $incidencias = Incidencia::all();
        } else {
            $incidencias = Consultas::getIncidencias();
        }
        return view('incidencias.welcome', ['incidencias' => $incidencias]);
    }

    public function show($id)
    {
        // Muestra una incidencia en concreto
        $incidencia = Incidencia::find($id);
        return view('incidencias.show', ['incidencia' => $incidencia]);
    }

    public function edit($id)
    {
        // Permite editar una incidencia en concreto y se envían los tipos de categoría
        $categorias = Categoria::where('disabled', false)->get();
        $incidencia = Incidencia::find($id);
        $categoriaIncidencia = Categoria::find($incidencia->id_cat);
        if (!$categorias->contains($categoriaIncidencia)) {
            $categorias->push($categoriaIncidencia);
        }
        $camposNulos = Consultas::getCamposNulos(Consultas::getCamposIncidencia());
        return view('incidencias.edit',  ['camposNulos' => $camposNulos, 'incidencia' => $incidencia, 'categorias' => $categorias]);
    }

    public function update(Request $request, $id)
    {
        // Recoge los datos y actualiza una incidencia
        //Recorre las imagenes subidas para almacenar sus nombres como JSON
        $datos = $this->agregarImagenes($request);
        $incidencia = Incidencia::find($id);
        //Actualiza la fecha de resolución si la incidencia está resuelta
        if ($datos['estado'] == 2) {
            $incidencia->fecha_resolucion = now();
        }
        //Realiza la actualización y muestra el panel de control
        $incidencia->update($datos);
        return redirect()->route('incidencias.welcome');
    }


    public function destroy($id)
    {
        //Borra la incidencia con el id enviado
        $incidencia = Incidencia::find($id);
        $incidencia->delete();
        //Muestra el panel de control
        return redirect()->route('incidencias.index');
    }

    protected function agregarImagenes(Request $request)
    {
        $datos = $request->all();
        $imgs = $request->file('adjuntar_imagen');
        if (isset($imgs)) {
            $imagenes = [];
            $index = count(array_filter(Storage::disk('uploads')->allFiles(), function ($v) {
                return str_starts_with($v, "imgInc");
            }));
            foreach ($request->file('adjuntar_imagen') as $k => $imagen) {
                $nombreArchivo = "imgInc" . ($index + $k + 1) . '.' . $imagen->extension();
                array_push($imagenes, $nombreArchivo);
                Storage::disk('uploads')->put($nombreArchivo, File::get($imagen));
            }
            $str_imagenes = json_encode($imagenes);
            $datos = array_replace($request->all(), ['adjuntar_imagen' => $str_imagenes]);
        }
        return $datos;
    }
}
