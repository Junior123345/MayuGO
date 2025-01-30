<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignados extends Model
{
    use HasFactory;

    // Nombre de la tabla si no sigue la convención
    protected $table = 'asignados';
    public $timestamps = false;

    // Relación con el modelo Curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_idcur', 'idcur');
    }


}
    