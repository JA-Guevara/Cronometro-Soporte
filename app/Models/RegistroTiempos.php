<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrotiempos extends Model
{
    use HasFactory;

    protected $table = 'registro_tiempos';

    protected $fillable = [
        'operador_id',
        'fecha',
        'hora_inicio',
        'hora_final',
        'tiempo_transcurrido',
    ];

    public $timestamps = true;
}
