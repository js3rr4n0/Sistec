<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Component Inventory | SISTEC</title>
    <style>
        body { font-family: Arial; background: #f5f6fa; padding: 2rem; margin: 0; }
        .container { background: #fff; padding: 2rem; border-radius: 8px; max-width: 1200px; margin: auto; }
        h2 { margin-bottom: 1rem; }

        .summary-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .summary-item {
            background-color: #eef1f9;
            padding: 1rem;
            border-radius: 6px;
            margin: 0.5rem;
            flex: 1 1 200px;
            text-align: center;
            font-weight: bold;
        }

        .filters {
            margin: 1rem 0;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filters input, .filters select {
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .alert {
            background: #ffdddd;
            color: #d8000c;
            padding: 1rem;
            border-left: 5px solid red;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 0.75rem;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        tr.low-stock {
            background-color: #fff3f3;
        }

        .btn {
            background: #2a5bff;
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .btn-small {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            margin-left: 1rem;
        }
    </style>
</head>
<body>
<div style="margin-top: 1rem;">
    <a href="{{ route('dashboard') }}" style="text-decoration:none; color:#2a5bff;">← Back to Dashboard</a>
</div>

<div class="container">
    <h2>Component Inventory</h2>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @php
        $lowStockCount = $components->where('Stock', '<', 10)->count();
        $totalValue = $components->sum(function ($c) {
            return $c->precio * $c->Stock;
        });
        $totalItems = $components->count();
    @endphp

    <div class="summary-box">
        <div class="summary-item">📦 Total Items: {{ $totalItems }}</div>
        <div class="summary-item">💰 Total Value: ${{ number_format($totalValue / 2, 2) }}</div>
        <div class="summary-item">⚠ Stock Bajo: {{ $lowStockCount }}</div>
    </div>

    <form method="GET" class="filters">
        <input type="text" name="nombre" placeholder="Search by name" value="{{ request('nombre') }}">
        
        <select name="tipo">
            <option value="">All Types</option>
            @foreach($types as $type)
                <option value="{{ $type }}" {{ request('tipo') == $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>

        <select name="stock">
            <option value="">All Stock</option>
            <option value="low" {{ request('stock') == 'low' ? 'selected' : '' }}>Stock Bajo</option>
            <option value="normal" {{ request('stock') == 'normal' ? 'selected' : '' }}>Stock Normal</option>
        </select>

        <button class="btn" type="submit">🔍 Buscar</button>
        <a href="{{ route('components.index') }}" class="btn">🔄 Limpiar</a>
    </form>

    <a href="{{ route('components.create') }}" class="btn">+ Add New Component</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Stock</th>
                <th>Min. Stock</th>
                <th>Location</th>
                <th>Description</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($components as $component)
                <tr @if($component->Stock < ($component->stock_minimo ?? 10)) class="low-stock" @endif>
                    <td>{{ $component->Nombre }}</td>
                    <td>{{ $component->Tipo }}</td>
                    <td>{{ $component->Stock }}</td>
                    <td>{{ $component->stock_minimo ?? 'N/A' }}</td>
                    <td>{{ $component->ubicacion ?? '—' }}</td>
                    <td>{{ $component->descripcion ?? '—' }}</td>
                    <td>
                        @if($component->Stock < ($component->stock_minimo ?? 10))
                            <a href="{{ route('movimientos.registro') }}" class="btn btn-small">Ordenar Más</a>
                            
                        @else
                            —
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No se encontraron resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
