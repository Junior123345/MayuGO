<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWeb extends Model
{
    protected $table = 'user_web'; // Asegúrate de que coincida con el nombre de tu tabla
    public $timestamps = false; // Si no usas timestamps, desactívalos

    // Relación con PayDiplomado (si aplica)

    public function payDiplomados()
    {
        return $this->hasMany(PayDiplomado::class, 'iduser', 'idalum');
    }
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'idalum', 'idalum');
    }
    public function premium()
    {
        return $this->hasMany(Premium::class, 'idalumno', 'idalum');
    }

}
