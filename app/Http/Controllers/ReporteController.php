<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        $fallasPorCategoria = DB::table('casosoporte')
            ->select('Categoria', DB::raw('count(*) as total'))
            ->groupBy('Categoria')
            ->pluck('total', 'Categoria')
            ->toArray();

        $fallasPorDispositivo = DB::table('casosoporte')
            ->select('TipoDispositivo', DB::raw('count(*) as total'))
            ->groupBy('TipoDispositivo')
            ->pluck('total', 'TipoDispositivo')
            ->toArray();

        return view('cases.reportes', compact('fallasPorCategoria', 'fallasPorDispositivo'));
    }
}
