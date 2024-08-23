<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operador;

class OperadorController extends Controller
{


    public function index(){

        return view("index");
    }


    public function checkUser(Request $request)
    {
        $usuarioDeLaMaquina = getenv('USERNAME');
        $operador = Operador::where('usuario', $usuarioDeLaMaquina)->first();
    
        if ($request->input('action') === 'registrar') {
            // Almacena el usuario en la sesión
            session(['usuarioDeLaMaquina' => $usuarioDeLaMaquina]);
            return redirect()->route('operador.create');
        }
    
        if ($operador) {
            return redirect()->route('cronometro.index');
        } else {
            // Almacena el usuario en la sesión
            session(['usuarioDeLaMaquina' => $usuarioDeLaMaquina]);
            return redirect()->route('operador.create');
        }
    }

    public function create()
    {
        $usuarioDeLaMaquina = session('usuarioDeLaMaquina');
        return view('operador.create', compact('usuarioDeLaMaquina'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string|max:50|unique:operador',
            'ci' => 'required|numeric|digits_between:1,10|unique:operador',
            'nombre' => 'required|string|max:100',
        ]);

        Operador::create($request->all());

        return redirect()->route('cronometro.index')->with('success', 'Operador registrado exitosamente.');
    }
}
