<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComponentController extends Controller
{
    public function sugerencias()
    {
        // Componentes con stock bajo
        $bajoStock = DB::table('componente')
            ->leftJoin('movimiento_inventario', 'componente.Id', '=', 'movimiento_inventario.ComponenteId')
            ->select(
                'componente.Id',
                'componente.Nombre',
                DB::raw('
                    IFNULL(SUM(CASE WHEN movimiento_inventario.TipoMovimiento = "Entrada" THEN movimiento_inventario.Cantidad ELSE 0 END), 0) -
                    IFNULL(SUM(CASE WHEN movimiento_inventario.TipoMovimiento = "Salida" THEN movimiento_inventario.Cantidad ELSE 0 END), 0)
                    AS Stock
                ')
            )
            ->groupBy('componente.Id', 'componente.Nombre')
            ->havingRaw('Stock < 10')
            ->get();
    
        // Componentes más utilizados (más salidas)
        $masUsados = DB::table('movimiento_inventario')
            ->join('componente', 'componente.Id', '=', 'movimiento_inventario.ComponenteId')
            ->where('movimiento_inventario.TipoMovimiento', 'Salida')
            ->select('componente.Nombre', DB::raw('SUM(movimiento_inventario.Cantidad) as total_salidas'))
            ->groupBy('componente.Nombre')
            ->orderByDesc('total_salidas')
            ->limit(10)
            ->pluck('total_salidas', 'Nombre');
    
        return view('components.sugerencias', compact('bajoStock', 'masUsados'));
    }
    
}
