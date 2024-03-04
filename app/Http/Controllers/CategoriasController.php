<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Empresa;
use Illuminate\Support\Facades\Cache;

class CategoriasController extends Controller
{

    public function categoriasCreate()
    {
        $empresas = Empresa::all();
        return view('categorias.create', ['empresas' => $empresas]);
    }

    public function categoriasStore(Request $request)
    {
        $idEmpresa = null;
        if ($request->input('empresa') != 0) {
            $idEmpresa = (int)$request->input('empresa');
        }
        $languageDirectories = scandir(resource_path('lang'));
        $languages = array_filter($languageDirectories, function ($dir) {
            return !in_array($dir, ['.', '..']) && is_dir(resource_path('lang/' . $dir));
        });
        $cat =  preg_replace('/\s/', "_", trim($request->nomes));
        $cat = ("categoria_" . $cat);
        Categoria::create(["tipo" => $cat, "id_empresa" => $idEmpresa, "disabled" => false]);
        foreach ($languages as $language) {
            $v = $request->input("nom" . $language);
            // Construye la ruta al archivo de idioma
            $filePath = resource_path("lang/$language/categorias.php");
            // Abre el archivo de idioma
            $translations = require $filePath;
            // Agrega la nueva traducción al arreglo
            $translations[$cat] = ucfirst($v);
            // Escribe el contenido actualizado de vuelta al archivo
            file_put_contents($filePath, '<?php return ' . var_export($translations, true) . ';');
            // Opcional: Borra la caché de traducciones para refrescar los cambios
            Cache::forget("lang.$language");
        }
        return redirect()->route('categorias.show');
    }

    public function categoriasShow()
    {
        $empresas = Empresa::all();
        $categorias = Categoria::where('disabled', false)->get();
        return view('categorias.index', ['categorias' => $categorias, 'empresas' => $empresas]);
    }

    public function categoriasEdit($id)
    {
        // Aquí puedes agregar la lógica para la edición de categorías
        $categoria = Categoria::find($id);
        $empresas = Empresa::all();
        //Realiza la actualización y muestra el panel de control
        return view('categorias.edit', ['categoria' => $categoria, 'empresas' => $empresas]);
    }

    public function categoriasUpdate(Request $request, $id)
    {
        $idEmpresa = null;
        if ($request->input('empresa') != 0) {
            $idEmpresa = (int)$request->input('empresa');
        }
        $languageDirectories = scandir(resource_path('lang'));
        $languages = array_filter($languageDirectories, function ($dir) {
            return !in_array($dir, ['.', '..']) && is_dir(resource_path('lang/' . $dir));
        });
        // Recoge los datos y actualiza una categoria
        $cat =  preg_replace('/\s/', "_", trim($request->nomes));
        $cat = ("categoria_" . $cat);
        $categoria = Categoria::find($id);
        $categoria->update(["tipo" => $cat, "id_empresa" => $idEmpresa]);
        foreach ($languages as $language) {
            $v = $request->input("nom" . $language);
            // Construye la ruta al archivo de idioma
            $filePath = resource_path("lang/$language/categorias.php");
            // Abre el archivo de idioma
            $translations = require $filePath;
            // Agrega la nueva traducción al arreglo
            $translations[$cat] = ucfirst($v);
            // Escribe el contenido actualizado de vuelta al archivo
            file_put_contents($filePath, '<?php return ' . var_export($translations, true) . ';');
            // Opcional: Borra la caché de traducciones para refrescar los cambios
            Cache::forget("lang.$language");
        }
        //Realiza la actualización y muestra el panel de control
        return redirect()->route('categorias.show');
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->update(["disabled" => true]);
        //Muestra el panel de control
        return redirect()->route('categorias.show');
    }
}
