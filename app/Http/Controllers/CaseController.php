<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{
    public function index()
    {
        $cases = DB::table('casosoporte')
            ->leftJoin('cliente', 'casosoporte.ClienteId', '=', 'cliente.Id')
            ->leftJoin('tecnico', 'casosoporte.TecnicoId', '=', 'tecnico.Id')
            ->select(
                'casosoporte.*',
                'cliente.Nombre as cliente_nombre',
                'tecnico.Nombre as tecnico_nombre'
            )
            ->orderBy('FechaSolicitud', 'desc')
            ->get();

        $total = $cases->count();
        $critical = $cases->where('Prioridad', 'High')->count();
        $completed = 0; // Puedes reemplazar si luego añades estado
        $inProgress = $total - $completed;

        return view('cases.index', compact(
            'cases', 'total', 'critical', 'inProgress', 'completed'
        ));
    }
}
