<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'operador';

    // Define qué atributos son asignables en masa
    protected $fillable = ['usuario', 'ci', 'nombre'];

    // Habilita los timestamps si tu tabla los usa
    public $timestamps = true;
}
