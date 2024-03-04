<?php

namespace App\Http\Controllers;

use App\Models\Consultas;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $nivel = Consultas::getNivel();
        if ($nivel == 3) {
            $usuarios = User::all();
        } else {
            $roles = Consultas::getRolesInferiores($nivel);
            $rolesArray = [];
            foreach ($roles as $rol) {
                array_push($rolesArray, ($rol->name));
            }
            $usuarios = User::whereIn('rol', $rolesArray)->get();
        }
        $empresas = Empresa::all();
        return view('usuarios.index', compact('usuarios', 'empresas'));
    }

    public function create()
    {
        $nivel = Consultas::getNivel();
        $roles = Consultas::getRolesInferiores($nivel);
        $empresas = Empresa::select('id', 'nombre')->get();
        return view('usuarios.signup', compact('empresas', 'roles'));
    }

    public function store(Request $request)
    {
        // Comprueba si el email está duplicado
        $emailDuplicado = $this->esMailDuplicado($request->email);
        // Guardar el usuario en la base de datos
        if (!$emailDuplicado) {
            $rol = (($request->empresa && $request->rol != "admin") ? $request->rol : "sinRol");
            $user = User::create([
                'name' => $request->name,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'password' => Hash::make($request->pass),
                'rol' => $rol,
                'id_empresa' => $request->empresa
            ]);
            return redirect()->route('usuarios.index');
        }
        $nivel = Consultas::getNivel();
        $roles = Consultas::getRolesInferiores($nivel);
        $empresas = Empresa::select('id', 'nombre')->get();
        return view('usuarios.signup', compact('empresas', 'roles', 'emailDuplicado'));
    }

    public function show($id)
    {
        $usuario = User::find($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        $empresas = Empresa::all();
        $nivel = Consultas::getNivel();
        $roles = Consultas::getRolesInferiores($nivel);
        return view('usuarios.edit', compact('usuario', 'empresas', 'roles'));
    }

    public function update(Request $request, $id)
    {
        //Recoge el usuario original
        $user = User::find($id);
        // Comprueba si el email está duplicado
        $emailDuplicado = $this->esMailDuplicado($request->input('email'));
        // Guardar el usuario en la base de datos
        if ($user->email == $request->input('email') || !$emailDuplicado) {
            $rol = (($request->empresa && $request->rol != "gestor") ? $request->rol : "sinRol");
            $user->update([
                'name' => $request->input('name'),
                'telefono' => $request->input('telefono'),
                'email' => $request->input('email'),
                'rol' => $rol,
                'id_empresa' => $request->input('empresa'),
            ]); 
            //Vuelve a la vista del panel
            return redirect()->route('usuarios.index');
        }
        $nivel = Consultas::getNivel();
        $roles = Consultas::getRolesInferiores($nivel);
        $empresas = Empresa::select('id', 'nombre')->get();
        return view('usuarios.edit', compact('empresas', 'roles', 'emailDuplicado'));
       
    }

    public function destroy($id)
    {
        //Borra el usuario con el id enviado
        $usuario = User::find($id);
        $usuario->delete();
        //Vuelve a la vista del panel
        return redirect()->route('usuarios.index');
    }

    protected function esMailDuplicado($email)
    {
        $usuarioExistente = User::where('email', $email)->first();
        return ($usuarioExistente != null ? true : false);
    }
}
