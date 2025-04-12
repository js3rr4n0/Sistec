<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{
    
    public function index(Request $request)
    {
        $cases = DB::table('casosoporte')
            ->leftJoin('cliente', 'casosoporte.ClienteId', '=', 'cliente.Id')
            ->leftJoin('tecnico', 'casosoporte.TecnicoId', '=', 'tecnico.Id')
            ->leftJoin('seguimientocaso', 'casosoporte.Id', '=', 'seguimientocaso.CasoSoporteId')
            ->select(
                'casosoporte.*',
                'cliente.Nombre as cliente_nombre',
                'tecnico.Nombre as tecnico_nombre',
                'seguimientocaso.Estado as estado'
            )
            ->when($request->search, fn($q) => $q->where('casosoporte.Titulo', 'like', '%' . $request->search . '%'))
            ->when($request->prioridad, fn($q) => $q->where('casosoporte.Prioridad', $request->prioridad))
            ->orderBy('FechaSolicitud', 'desc')
            ->get();

        $total = $cases->count();
        $critical = $cases->where('Prioridad', 'High')->count();
        $completed = $cases->where('estado', 'Finalizado')->count();
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
        ini_set('memory_limit', '4096M');
        $cases = DB::table('casosoporte')
            ->leftJoin('tecnico', 'casosoporte.TecnicoId', '=', 'tecnico.Id')
            ->select('casosoporte.*', 'tecnico.Nombre as tecnico_nombre')
            ->paginate(20);

        $tecnicos = DB::table('tecnico')->get();

        return view('cases.assign', compact('cases', 'tecnicos'));
    }
    
}
