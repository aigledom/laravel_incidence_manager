<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function create()
    {
        $categorias = Categoria::whereNull('id_empresa')->get();
        return view('empresas.create', ['categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        $categorias = $request->input('categorias');
        $empresa = Empresa::create($request->all());
        if (isset($categorias)) {
            $categorias = explode(',', $request->input('categorias'));
            foreach ($categorias as $k => $idCat) {
                Categoria::find((int)$idCat)->update(['id_empresa' => (int)$empresa->id]);
            }
        }

         return redirect()->route('empresas.show');
    }

    public function show()
    {
        $categorias = Categoria::all();
        $empresas = Empresa::all();
        return view('empresas.index', ['empresas' => $empresas, 'categorias' => $categorias]);
    }

    public function edit($id)
    {
        $categorias = (Categoria::where('id_empresa', $id)->get())->merge(Categoria::whereNull('id_empresa')->get());
        $empresa = Empresa::find($id);
        return view('empresas.edit', ['categorias' => $categorias, 'empresa' => $empresa]);
    }

    public function update(Request $request, $id)
    {
        $cats = explode(',', $request->input('categorias'));
        $categorias = Categoria::all();
        foreach ($categorias as $categoria) {
            if (in_array(($categoria->id), $cats)) {
                $categoria->update(['id_empresa' => (int)$id]);
            } else {
                if ($categoria->id_empresa == $id) {
                    $categoria->update(['id_empresa' => null]);
                }
            }
        }
        Empresa::find($id)->update($request->all());
         return redirect()->route('empresas.show');
    }

    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        $categorias = Categoria::where('id_empresa', $id)->get();
        $usuarios = User::where('id_empresa', $id)->get();
        if (isset($categorias)) {
            foreach ($categorias as $categoria) {
                $categoria->update(['id_empresa' => null]);
            }
        }
        if (isset($usuarios)) {
            foreach ($usuarios as $usuario) {
                $usuario->delete();
            }
        }
        $empresa->delete();
        //Muestra el panel de control
         return redirect()->route('empresas.show');
    }
}
