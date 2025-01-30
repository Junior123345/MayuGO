<?php
// app/Models/PayDiplomado.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Premium extends Model
{
    protected $table = 'premium'; // Nombre de la tabla en la base de datos
    public $timestamps = false; // Si no estás usando timestamps

    // Relación con UserWeb
    public function user()
    {
        return $this->belongsTo(UserWeb::class, 'idalumno', 'idalum');
    }

}
