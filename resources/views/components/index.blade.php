<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Component Inventory | SISTEC</title>
    <a href="{{ route('dashboard') }}" class="btn">← Dashboard</a>
    <style>
        body { font-family: Arial; background: #f5f6fa; padding: 2rem; margin: 0; }
        .container { background: #fff; padding: 2rem; border-radius: 8px; max-width: 1100px; margin: auto; }
        h2 { margin-bottom: 1.5rem; }
        .alert { background: #ffdddd; color: #d8000c; padding: 1rem; border-left: 5px solid red; margin-bottom: 1rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.75rem; border-bottom: 1px solid #ccc; text-align: left; }
        tr.low-stock { background-color: #fff3f3; }
        .btn { background: #2a5bff; color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 5px; text-decoration: none; cursor: pointer; margin-bottom: 1rem; display: inline-block; }
    </style>
</head>
<body>
<div class="container">
    <h2>Component Inventory</h2>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @php
        $hasLowStock = $components->contains(function ($comp) {
            return $comp->Stock < ($comp->stock_minimo ?? 10);
        });
    @endphp

    @if ($hasLowStock)
        <div class="alert">
            ⚠ Algunos componentes tienen stock por debajo del mínimo permitido. Considera realizar reposición.
        </div>
    @endif

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
            </tr>
        </thead>
        <tbody>
            @foreach($components as $component)
                <tr @if($component->Stock < ($component->stock_minimo ?? 10)) class="low-stock" @endif>
                    <td>{{ $component->Nombre }}</td>
                    <td>{{ $component->Tipo }}</td>
                    <td>{{ $component->Stock }}</td>
                    <td>{{ $component->stock_minimo ?? 'N/A' }}</td>
                    <td>{{ $component->ubicacion ?? '—' }}</td>
                    <td>{{ $component->descripcion ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
