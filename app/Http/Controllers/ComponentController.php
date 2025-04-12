<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComponentController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('componente')
            ->select(
                'componente.*',
                DB::raw('(
                    SELECT 
                        IFNULL(SUM(CASE WHEN TipoMovimiento = "Entrada" THEN Cantidad ELSE 0 END), 0) -
                        IFNULL(SUM(CASE WHEN TipoMovimiento = "Salida" THEN Cantidad ELSE 0 END), 0)
                    FROM movimiento_inventario
                    WHERE ComponenteId = componente.Id
                ) AS Stock')
            );

        // Filtros
        if ($request->nombre) {
            $query->where('Nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->tipo) {
            $query->where('Tipo', $request->tipo);
        }

        if ($request->stock == 'low') {
            $query->having('Stock', '<', 10);
        } elseif ($request->stock == 'normal') {
            $query->having('Stock', '>=', 10);
        }

        // Paginación de 20 por página
        $components = $query->paginate(20)->withQueryString();

        // Obtener los tipos para el select
        $types = DB::table('componente')->select('Tipo')->distinct()->pluck('Tipo');

        return view('components.index', compact('components', 'types'));
    }
}
