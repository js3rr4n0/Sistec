<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Case Detail</title>
    <style>
        body { font-family: Arial; padding: 2rem; background: #f5f5f5; }
        .container { background: white; padding: 2rem; border-radius: 8px; max-width: 800px; margin: auto; }
        h2 { margin-bottom: 1rem; }
        label { display: block; margin-top: 1rem; font-weight: bold; }
        textarea, select { width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 5px; }
        .btn { margin-top: 1rem; background: #2a5bff; color: white; border: none; padding: 0.5rem 1rem; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Case: {{ $case->Titulo }}</h2>
    <p><strong>Cliente:</strong> {{ $case->cliente_nombre ?? 'No asignado' }}</p>
    <p><strong>Técnico:</strong> {{ $case->tecnico_nombre ?? 'No asignado' }}</p>
    <p><strong>Prioridad:</strong> {{ $case->Prioridad }}</p>
    <p><strong>Descripción:</strong> {{ $case->Descripcion }}</p>

    <form method="POST" action="{{ route('cases.update', $case->Id) }}">
        @csrf
        <label for="estado">Estado:</label>
        <select name="estado" id="estado">
            <option {{ ($seguimiento->Estado ?? '') === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option {{ ($seguimiento->Estado ?? '') === 'En proceso' ? 'selected' : '' }}>En proceso</option>
            <option {{ ($seguimiento->Estado ?? '') === 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
        </select>

        <label for="diagnostico">Diagnóstico:</label>
        <textarea name="diagnostico" rows="3">{{ $seguimiento->Diagnostico ?? '' }}</textarea>

        <label for="solucion">Solución:</label>
        <textarea name="solucion" rows="3">{{ $seguimiento->Solucion ?? '' }}</textarea>

        <button class="btn" type="submit">Guardar seguimiento</button>
    </form>
</div>
<div style="margin-top: 1.5rem;">
    <a href="{{ route('cases.index') }}" style="text-decoration: none; padding: 0.5rem 1rem; background-color: #ccc; color: black; border-radius: 5px;">
        ← Volver a la lista de casos
    </a>
</div>

</body>
</html>
