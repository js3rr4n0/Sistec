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
    public function show($id)
    {
        $case = DB::table('casosoporte')
            ->leftJoin('cliente', 'casosoporte.ClienteId', '=', 'cliente.Id')
            ->leftJoin('tecnico', 'casosoporte.TecnicoId', '=', 'tecnico.Id')
            ->select(
                'casosoporte.*',
                'cliente.Nombre as cliente_nombre',
                'tecnico.Nombre as tecnico_nombre'
            )
            ->where('casosoporte.Id', $id)
            ->first();
    
        if (!$case) {
            return redirect()->route('cases.index')->withErrors(['msg' => 'El caso no existe']);
        }
    
        $seguimiento = DB::table('seguimientocaso')->where('CasoSoporteId', $id)->first();
    
        return view('cases.show', compact('case', 'seguimiento'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'estado' => 'required',
        'diagnostico' => 'nullable',
        'solucion' => 'nullable',
    ]);

    $seguimiento = DB::table('seguimientocaso')->where('CasoSoporteId', $id)->first();

    if ($seguimiento) {
        DB::table('seguimientocaso')->where('CasoSoporteId', $id)->update([
            'Estado' => $request->estado,
            'Diagnostico' => $request->diagnostico,
            'Solucion' => $request->solucion,
            'FechaActualizacion' => now(),
        ]);
    } else {
        DB::table('seguimientocaso')->insert([
            'Id' => uniqid(),
            'CasoSoporteId' => $id,
            'Estado' => $request->estado,
            'Diagnostico' => $request->diagnostico,
            'Solucion' => $request->solucion,
            'FechaActualizacion' => now(),
        ]);
    }

    return back()->with('success', 'Seguimiento actualizado correctamente');
}
public function bulkAssign(Request $request)
{
    foreach ($request->assignments as $caseId => $tecnicoId) {
        if ($tecnicoId) {
            DB::table('casosoporte')->where('Id', $caseId)->update(['TecnicoId' => $tecnicoId]);
        }
    }

    return redirect()->route('cases.assign')->with('success', 'Technician assignments updated successfully.');
}
public function assignView()
{
    $cases = DB::table('casosoporte')->get();
    $tecnicos = DB::table('tecnico')->get();

    return view('cases.assign', compact('cases', 'tecnicos'));
}

}
