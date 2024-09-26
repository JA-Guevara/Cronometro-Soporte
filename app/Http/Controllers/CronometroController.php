<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroTiempos;
use App\Models\Operador;
use Carbon\Carbon;

class CronometroController extends Controller
{
    public function index()
    {

        $remoteUser = $_SERVER['REMOTE_USER']; // Ejemplo: DOMINIO\a.bazan
        // Si necesitas extraer solo el nombre de usuario sin el dominio:
        list($domain, $username) = explode('\\', $remoteUser);
        $operador = Operador::where('usuario', $username)->first();

        // Obtén el registro de cronómetro en ejecución (si existe)
        $registro = RegistroTiempos::where('operador_id', $operador->id ?? 0)
                                   ->whereNull('hora_final')
                                   ->latest()
                                   ->first();

        // Obtén los registros históricos
        $registrosHistoricos = RegistroTiempos::where('operador_id', $operador->id ?? 0)
        ->orderBy('fecha', 'desc')
        ->take(10)  // Limita la consulta a los últimos 10 registros
        ->get();
        // Obtén la fecha actual
        $fechaActual = Carbon::now()->format('Y-m-d');

        return view('cronometro.index', compact('operador', 'registro', 'registrosHistoricos', 'fechaActual'));
    }

    public function start(Request $request)
    {
        $registro = new RegistroTiempos();
        $registro->operador_id = $request->operador_id;
        $registro->fecha = now()->format('Y-m-d'); // Fecha actual
        $registro->hora_inicio = now()->format('H:i:s');
        $registro->save();
    
        return response()->json([
            'registro_id' => $registro->id,
            'hora_inicio' => $registro->hora_inicio,
            'fecha' => $registro->fecha,
        ]);
    }
    
    public function stop(Request $request)
    {
        $registro = RegistroTiempos::find($request->registro_id);
        $registro->hora_final = now()->format('H:i:s');
        $registro->tiempo_transcurrido = $this->calcularTiempoTranscurrido($registro->hora_inicio, $registro->hora_final);
        $registro->save();
    
        return response()->json([
            'hora_final' => $registro->hora_final,
            'tiempo_transcurrido' => $registro->tiempo_transcurrido,
        ]);
    }
    
    private function calcularTiempoTranscurrido($horaInicio, $horaFin)
    {
        $inicio = new \DateTime($horaInicio);
        $fin = new \DateTime($horaFin);
        $intervalo = $inicio->diff($fin);
        return $intervalo->format('%H:%I:%S');
    }
    
}