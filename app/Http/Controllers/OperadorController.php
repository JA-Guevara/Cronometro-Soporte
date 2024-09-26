<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operador;

class OperadorController extends Controller
{
    /**
     * Muestra la vista de inicio.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Verifica el usuario y redirige según sea necesario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkUser(Request $request)
    {
        // Verifica que REMOTE_USER esté definido
        $remoteUser = $_SERVER['REMOTE_USER'] ?? null;

        if (!$remoteUser) {
            // Maneja el caso en el que no se pudo obtener REMOTE_USER
            return redirect()->route('operador.create')->with('error', 'No se pudo obtener el usuario de la máquina.');
        }

        // Verifica que REMOTE_USER tenga el formato esperado
        $parts = explode('\\', $remoteUser);
        if (count($parts) !== 2) {
            return redirect()->route('operador.create')->with('error', 'Formato de usuario no válido.');
        }

        list($domain, $username) = $parts;

        // Almacena el usuario en la sesión
        session(['username' => $username]);

        // Busca al operador en la base de datos
        $operador = Operador::where('usuario', $username)->first();

        // Redirige según la acción o si el operador no existe
        if ($request->input('action') === 'registrar' || !$operador) {
            return redirect()->route('operador.create');
        }

        return redirect()->route('cronometro.index');
    }

    /**
     * Muestra la vista de creación de operadores.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Recupera el nombre de usuario de la sesión
        $username = session('username');
        // Verifica si el nombre de usuario está disponible
        if (!$username) {
            return redirect()->route('operador.index')->with('error', 'No se pudo recuperar el nombre de usuario.');
        }
        return view('operador.create', compact('username'));
    }

    /**
     * Guarda un nuevo operador en la base de datos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'usuario' => 'required|string|max:50|unique:operador',
            'ci' => 'required|numeric|digits_between:1,10|unique:operador',
            'nombre' => 'required|string|max:100',
        ]);

        // Crea un nuevo operador en la base de datos
        Operador::create($request->all());

        // Redirige con un mensaje de éxito
        return redirect()->route('cronometro.index')->with('success', 'Operador registrado exitosamente.');
    }
}
