<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function bienvenida($tipo = 'cliente')
    {
      return view('inicio/bienvenida-cliente',compact('tipo'));
    }
    public function registro($tipo = 'cliente')
    {

        return view('inicio/registro',compact('tipo'));

    }
    public function store(Request $request)
    {
        /*$registro = new Usuario();

        $registro->nombre = $request->nombre;
        $registro->correo = $request->correo;
        $registro->telefono = $request->telefono;
        $registro->contraseña = $request->contraseña;
        $registro->codigo = $request->codigo;
        $registro->peluqueria = $request->peluqueria;
        $registro->direccion = $request->direccion;


        $registro->save();*/

        return redirect()->route('bienvenida');
    }

}
