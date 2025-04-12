<!-- resources/views/components/sugerencias.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sugerencias de Compra | SISTEC</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 0;
        }
        header {
            background: #2a5bff;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
        }
        .container {
            padding: 2rem;
        }
        .card {
            background: white;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .btn {
            background-color: #2a5bff;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
<header>
    <h1>Sugerencias de Compra de Componentes</h1>
    <button class="btn" onclick="window.print()">Exportar a PDF</button>
</header>
<div class="container">
    <div class="card">
        <h3>Componentes más utilizados (Altas salidas)</h3>
        <canvas id="salidasChart"></canvas>
    </div>

    <div class="card">
        <h3>Componentes con Bajo Stock</h3>
        <table>
            <thead>
                <tr>
                    <th>Componente</th>
                    <th>Stock Actual</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bajoStock as $item)
                    <tr>
                        <td>{{ $item->Nombre }}</td>
                        <td>{{ $item->Stock }}</td>
                        <td>
                        <a href="{{ route('movimientos.registro') }}" class="btn">Ordenar Más</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    const salidasLabels = @json($masUsados->keys()->toArray());
const salidasData = @json($masUsados->values()->toArray());


    new Chart(document.getElementById('salidasChart'), {
        type: 'bar',
        data: {
            labels: salidasLabels,
            datasets: [{
                label: 'Salidas Totales',
                data: salidasData,
                backgroundColor: 'rgba(255, 99, 132, 0.7)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Componentes con Mayor Demanda' }
            }
        }
    });
</script>
</body>
</html>
