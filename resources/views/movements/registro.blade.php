<!-- resources/views/movements/registro.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Movement | SISTEC</title>
    <style>
        body { font-family: Arial; background: #f5f6fa; padding: 2rem; margin: 0; }
        .container { background: white; padding: 2rem; max-width: 1000px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { margin-bottom: 1rem; }
        label { display: block; margin-top: 1rem; font-weight: bold; }
        select, input, textarea { width: 100%; padding: 0.6rem; margin-top: 0.3rem; border-radius: 5px; border: 1px solid #ccc; }
        .btn { margin-top: 1rem; background: #2a5bff; color: white; padding: 0.7rem 1.5rem; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background: #1e47cc; }
        table { width: 100%; margin-top: 2rem; border-collapse: collapse; }
        th, td { padding: 0.75rem; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #f0f0f0; }
        .filters { display: flex; gap: 1rem; margin-top: 1rem; }
        .alert { padding: 1rem; border-radius: 5px; margin-top: 1rem; }
        .alert-success { background: #e0ffe0; color: green; border-left: 5px solid green; }
        .alert-error { background: #ffe0e0; color: darkred; border-left: 5px solid red; }
    </style>
</head>
<body>
<a href="{{ route('dashboard') }}" class="btn">← Dashboard</a>
<div class="container">
    <h2>Register Inventory Movement</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('movimientos.store') }}">
        @csrf
        <label for="componente_id">Component</label>
        <select name="componente_id" required>
            <option value="">-- Select Component --</option>
            @foreach($componentes as $comp)
                <option value="{{ $comp->Id }}">{{ $comp->Nombre }} (Stock: {{ $comp->Stock }})</option>
            @endforeach
        </select>

        <label for="tipo_movimiento">Movement Type</label>
        <select name="tipo_movimiento" required>
            <option value="entrada">Entrada</option>
            <option value="salida">Salida</option>
        </select>

        <label for="cantidad">Quantity</label>
        <input type="number" name="cantidad" min="1" required>

        <label for="notas">Notes (optional)</label>
        <textarea name="notas" rows="3"></textarea>

        <button type="submit" class="btn">Submit Movement</button>
    </form>

    <h2 style="margin-top: 3rem;">Movement History</h2>
    <form method="GET" class="filters">
        <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Search component name...">
        <select name="tipo">
            <option value="">All Types</option>
            <option value="Entrada" {{ request('tipo') === 'Entrada' ? 'selected' : '' }}>Entrada</option>
            <option value="Salida" {{ request('tipo') === 'Salida' ? 'selected' : '' }}>Salida</option>
        </select>
        <button class="btn" type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Component</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movimientos as $mov)
                <tr>
                    <td>{{ $mov->Nombre }}</td>
                    <td>{{ $mov->TipoMovimiento }}</td>
                    <td>{{ $mov->Cantidad }}</td>
                    <td>{{ \Carbon\Carbon::parse($mov->FechaMovimiento)->format('Y-m-d H:i') }}</td>
                    <td>{{ $mov->Notas }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No movements found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>