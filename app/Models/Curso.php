<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    // Nombre de la tabla si no sigue la convención
    protected $table = 'curso';
    public $timestamps = false;

    // Campos que se pueden asignar masivamente
   

    // Relación con el modelo Categoria


    // Relación con el modelo Asignados
    public function asignados()
    {
        return $this->hasMany(Asignados::class, 'curso_idcur', 'idcur');
    }
}
