<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InventoryReportController extends Controller
{
    public function componentesDemanda()
    {
        // Top 10 componentes más utilizados (por cantidad de salidas)
        $masUsados = DB::table('movimiento_inventario')
            ->join('componente', 'movimiento_inventario.ComponenteId', '=', 'componente.Id')
            ->where('TipoMovimiento', 'Salida')
            ->select('componente.Nombre', DB::raw('SUM(Cantidad) as total'))
            ->groupBy('componente.Nombre')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Proyección de demanda (por mes)
        $proyeccionMensual = DB::table('movimiento_inventario')
            ->where('TipoMovimiento', 'Salida')
            ->selectRaw("DATE_FORMAT(FechaMovimiento, '%Y-%m') as mes, SUM(Cantidad) as total")
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        return view('cases.reporte_componentes', compact('masUsados', 'proyeccionMensual'));
    }
}

