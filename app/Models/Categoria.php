<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Nombre de la tabla si no sigue la convención
    protected $table = 'categoria';

    // Relación con el modelo Curso
    public function cursos()
    {
        return $this->hasMany(Curso::class, 'idc', 'idc');
    }
}
