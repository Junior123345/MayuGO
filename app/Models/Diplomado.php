<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diplomado extends Model
{
    protected $table = 'diplomados'; // Asegúrate de que coincida con el nombre de tu tabla
    public $timestamps = false; // Si no usas timestamps, desactívalos

    // Relación con PayDiplomado (si aplica)
    public function payDiplomados()
    {
        return $this->hasMany(PayDiplomado::class, 'iddiplomado', 'iddiplomado');
    }
}
