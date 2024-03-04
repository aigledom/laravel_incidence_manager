<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function logout()
    {
        //Se controla la función de logout de la sesión
        Auth::logout();
        return redirect('/');
    }
}