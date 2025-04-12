<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Movement | SISTEC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 2rem;
        }
        .container {
            background: white;
            padding: 2rem;
            max-width: 900px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
        }
        select, input {
            width: 100%;
            padding: 0.6rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 0.3rem;
        }
        .btn {
            margin-top: 1.5rem;
            background: #2a5bff;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn:hover {
            background: #1e47cc;
        }
        .back-link {
            margin-top: 1rem;
            display: inline-block;
            text-decoration: none;
            color: #2a5bff;
        }
        .alert {
            background: #ffe8e8;
            color: #cc0000;
            padding: 1rem;
            border-left: 5px solid red;
            margin-top: 1rem;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }
        th, td {
            padding: 0.75rem;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Inventory Movement</h2>

    @if (session('error'))
        <div class="alert">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert" style="background:#e0ffe0; color:green; border-left-color:green;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('movimientos.store') }}">
        @csrf

        <label for="componente_id">Select Component</label>
        <select name="componente_id" required>
            <option value="">-- Select --</option>
            @foreach($componentes as $comp)
                <option value="{{ $comp->Id }}">{{ $comp->Nombre }} (Stock: {{ $comp->Stock }})</option>
            @endforeach
        </select>

        <label for="tipo">Movement Type</label>
        <select name="tipo" required>
            <option value="Entrada">Entrada (Add Stock)</option>
            <option value="Salida">Salida (Remove Stock)</option>
        </select>

        <label for="cantidad">Quantity</label>
        <input type="number" name="cantidad" min="1" required>

        <label for="notas">Notes (optional)</label>
        <input type="text" name="notas">

        <button class="btn" type="submit">Register Movement</button>
    </form>

    <hr style="margin:2rem 0;">

    <h2>Movement History</h2>

    <form method="GET" action="{{ route('movimientos.index') }}">
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <div style="flex: 1;">
                <label>Component Name</label>
                <input type="text" name="nombre" value="{{ request('nombre') }}">
            </div>
            <div style="flex: 1;">
                <label>Type</label>
                <select name="tipo">
                    <option value="">All</option>
                    <option value="Entrada" {{ request('tipo') == 'Entrada' ? 'selected' : '' }}>Entrada</option>
                    <option value="Salida" {{ request('tipo') == 'Salida' ? 'selected' : '' }}>Salida</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label>Date From</label>
                <input type="date" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
            </div>
            <div style="flex: 1;">
                <label>Date To</label>
                <input type="date" name="fecha_fin" value="{{ request('fecha_fin') }}">
            </div>
            <div style="flex: 1; align-self: flex-end;">
                <button type="submit" class="btn">Filter</button>
            </div>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Component</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($historial as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->FechaMovimiento)->format('Y-m-d') }}</td>
                    <td>{{ $item->Nombre }}</td>
                    <td>{{ $item->TipoMovimiento }}</td>
                    <td>{{ $item->Cantidad }}</td>
                    <td>{{ $item->Notas ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('dashboard') }}" class="back-link">← Back to Dashboard</a>
</div>
</body>
</html>
