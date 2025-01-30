<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    // Nombre de la tabla si no sigue la convención
    protected $table = 'inscripcion';
    public $timestamps = false;

 
    // Relación con el modelo UserWeb
    public function user()
    {
        return $this->belongsTo(UserWeb::class, 'idalum', 'idalum');
    }

    // Relación con el modelo Asignados
    public function asignados()
    {
        return $this->belongsTo(Asignados::class, 'asignados_idasig', 'idasig');
    }
}
