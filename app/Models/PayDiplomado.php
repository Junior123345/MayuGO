<?php
// app/Models/PayDiplomado.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayDiplomado extends Model
{
    protected $table = 'pay_diplomado'; // Nombre de la tabla en la base de datos
    public $timestamps = false; // Si no estás usando timestamps

    // Relación con UserWeb
    public function user()
    {
        return $this->belongsTo(UserWeb::class, 'iduser', 'idalum');
    }

    // Relación con Diplomados
    public function diplomado()
    {
        return $this->belongsTo(Diplomado::class, 'iddiplomado', 'iddiplomado');
    }
}
