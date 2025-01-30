@extends('adminlte::page')

@section('title', 'Planes')

@section('content_header')
@stop

@section('content')
<div class="container">
    <!-- Barra de búsqueda -->
    <form method="GET" action="{{ route('premium.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="busqueda" value="{{ $busqueda }}" class="form-control" placeholder="Buscar..." />
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
    <p><center><b>Planes</b></center></p>

    <!-- Tabla con datos -->
    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
    
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Servicio</th>
                    <th>Monto</th>
                    <th>Tipo pago</th>
                    <th>N° Transacción</th>
                    <th>Fecha.P</th>
                    <th>Reporte</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resultados as $registro)
                @php
                        // Verificar si hay un término de búsqueda y si coincide con alguno de los campos
                        $coincide = !empty($busqueda) && (
                            stripos($registro->idpremium, $busqueda) !== false ||
                            stripos($registro->user->nombres, $busqueda) !== false || // Buscar en nombres
                            stripos($registro->user->apellidos, $busqueda) !== false || // Buscar en apellidos
                            stripos($registro->user->email, $busqueda) !== false || // Buscar en email
                            stripos($registro->user->telf, $busqueda) !== false // Buscar en teléfono
                        );
                    @endphp
                <tr style="{{ $coincide ? 'background-color: yellow;' : '' }}">
                    <td>{{ $registro->idpremium }}</td>
                    <td>{{ $registro->user->nombres}}</td>
                    <td>{{ $registro->user->apellidos}}</td>
                    <td>{{ $registro->user->telf ?? 'No disponible' }}</td>
                    <td>{{ $registro->user->email ?? 'No disponible' }}</td>
                    <td>{{ $registro->servicio ?? 'No disponible' }}</td>
                    <td>{{ $registro->monto ?? 'No disponible' }}</td>
                    <td>{{ $registro->tipo_pago }}</td>
                    <td>{{ $registro->nro_trans }}</td>
                    <td>{{ \Carbon\Carbon::parse($registro->fecha_pago)->format('d/m/Y') }}</td>
                    
                    <td>
                        <button 
                            type="button" 
                            class="btn btn-outline-info btn-sm" 
                            onclick="window.location.href=' https://www.mayugo.net/step-pago/mifactura.php?email={{ urlencode($registro->user->email ?? '') }}'">
                            <i class="bi bi-arrow-down-circle"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación personalizada -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <!-- Botón "Anterior" -->
            @if ($resultados->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" href="{{ $resultados->previousPageUrl() }}&busqueda={{ $busqueda }}" aria-label="Anterior">
                    <span aria-hidden="true">&laquo; Anterior</span>
                </a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link">&laquo; Anterior</span>
            </li>
            @endif

            <!-- Números de página -->
            @for ($i = 1; $i <= $resultados->lastPage(); $i++)
            <li class="page-item {{ $i == $resultados->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $resultados->url($i) }}&busqueda={{ $busqueda }}">{{ $i }}</a>
            </li>
            @endfor

            <!-- Botón "Siguiente" -->
            @if ($resultados->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $resultados->nextPageUrl() }}&busqueda={{ $busqueda }}" aria-label="Siguiente">
                    <span aria-hidden="true">Siguiente &raquo;</span>
                </a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link">Siguiente &raquo;</span>
            </li>
            @endif
        </ul>
    </nav>
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<style>
   

    .table-responsive {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        background: #f9f9f9;
        max-height: 300px; /* Altura máxima del contenedor con scroll */
        overflow-y: auto; /* Habilita el scroll vertical */
    }
    .table th, .table td {
        vertical-align: middle;
        padding: 5px; /* Reduce el espacio interno */
        font-size: 0.9rem; /* Tamaño de fuente más pequeño */
        max-width: 110px; /* Ancho máximo de la celda */
        white-space: nowrap; /* Evita que el texto haga salto de línea */
        overflow: hidden; /* Oculta el texto que exceda el ancho */
        text-overflow: ellipsis; /* Muestra puntos suspensivos si el texto es muy largo */
    }
    .table th {
        background-color: #000; /* Fondo negro para el encabezado */
        color: #fff; /* Texto blanco */
        font-weight: bold;
        position: sticky; /* Fija el encabezado */
        top: 0; /* Mantiene el encabezado en la parte superior */
        z-index: 2; /* Asegura que esté encima del contenido */
    }
    .table tr:hover {
        background-color: #f5f5f5; /* Efecto hover para destacar la fila */
    }
    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }
    .pagination .page-link {
        padding: 5px 10px; /* Reduce el tamaño de los botones de paginación */
        font-size: 0.9rem;
    }
</style>


@stop

@section('js')
    <script> console.log("Cursos en Vivo - Listo para interactuar."); </script>
@stop
