<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayDiplomado;

class VivoController extends Controller
{
    public function index(Request $request)
    {
        // Definir la cantidad de registros por página
        $registrosPorPagina = 500; // Asegúrate de que sea el valor correcto

        // Obtener el término de búsqueda, si existe
        $busqueda = $request->input('busqueda', '');

        // Consulta principal con relaciones
        $query = PayDiplomado::query()
            ->with(['user', 'diplomado']) // Carga las relaciones necesarias
            ->when($busqueda, function ($q) use ($busqueda) {
                $q->where('idpay', 'like', "%$busqueda%")
                  ->orWhereHas('user', function ($query) use ($busqueda) {
                      $query->where('nombres', 'like', "%$busqueda%")
                            ->orWhere('apellidos', 'like', "%$busqueda%")
                            ->orWhere('email', 'like', "%$busqueda%");
                  });
            })
            ->orderBy('fecha', 'desc'); // Ordenar por fecha de forma descendente

        
        $resultados = $query->paginate($registrosPorPagina);

      
        return view('vivo.vivo', [
            'resultados' => $resultados,
            'busqueda' => $busqueda,
            'idBuscado' => $busqueda,
        ]);
    }
}
