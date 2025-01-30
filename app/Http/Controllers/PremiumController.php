<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Premium;

class PremiumController extends Controller
{
    public function index(Request $request)
    {
        // Definir la cantidad de registros por página
        $registrosPorPagina = 200; // Asegúrate de que sea el valor correcto

        // Obtener el término de búsqueda, si existe
        $busqueda = $request->input('busqueda', '');

        // Consulta principal con relaciones
        $query = Premium::query()
            ->with(['user']) // Carga las relaciones necesarias
            ->when($busqueda, function ($q) use ($busqueda) {
                $q->where('idpremium', 'like', "%$busqueda%")
                  ->orWhereHas('user', function ($query) use ($busqueda) {
                      $query->where('nombres', 'like', "%$busqueda%")
                            ->orWhere('apellidos', 'like', "%$busqueda%")
                            ->orWhere('telf', 'like', "%$busqueda%")
                            ->orWhere('email', 'like', "%$busqueda%");
                  });
            })
            ->orderBy('fecha_pago', 'desc'); // Ordenar por fecha de forma descendente

        // Paginación de los resultados
        $resultados = $query->paginate($registrosPorPagina);

        // Debugging para verificar resultados
        // dd($resultados->total(), $resultados->perPage(), $resultados->items());

        // Retornar la vista con los resultados y la búsqueda
        return view('premium.index', [
            'resultados' => $resultados,
            'busqueda' => $busqueda,
        ]);
    }
}
