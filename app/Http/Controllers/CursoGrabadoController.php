<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursoGrabadoController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda', '');
        $registrosPorPagina = 1500; // Número de registros por página

        // 🔹 Si hay búsqueda, usa el procedimiento con filtro
        if (!empty($busqueda)) {
            $cursos = DB::select("CALL GetCursosGrabadosConBusqueda(?)", [$busqueda]);
        } else {
            // 🔹 Si no hay búsqueda, usa el procedimiento sin filtro
            $cursos = DB::select("CALL GetCursosGrabados()");
        }

        // 🔹 Convertir resultados en colección para paginación manual
        $pagina = request()->input('page', 1); 
        $cursos = collect($cursos); 
        $paginados = new \Illuminate\Pagination\LengthAwarePaginator(
            $cursos->forPage($pagina, $registrosPorPagina),
            $cursos->count(),
            $registrosPorPagina,
            $pagina,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('cursos_grabados.index', [
            'resultados' => $paginados,
            'busqueda' => $busqueda
        ]);
    }
}
