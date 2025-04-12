<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Componentes Usados | SISTEC</title>
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
            font-size: 1.5rem;
        }
        .container {
            padding: 2rem;
        }
        .chart-box {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        .btn-export {
            background-color: #2a5bff;
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }
    </style>
</head>
<body>
<header>
    <h1>Reporte de Componentes en Reparaciones</h1>
    <button class="btn-export" onclick="window.print()">Exportar PDF</button>
</header>

<div class="container">
    <div class="chart-box">
        <h3>Top Componentes Usados</h3>
        <canvas id="masUsadosChart"></canvas>
    </div>

    <div class="chart-box">
        <h3>Proyección de Demanda (Mensual)</h3>
        <canvas id="proyeccionChart"></canvas>
    </div>
</div>

<script>
    const usadosLabels = @json($masUsados->pluck('Nombre'));
    const usadosData = @json($masUsados->pluck('total'));

    const proyeccionLabels = @json($proyeccionMensual->pluck('mes'));
    const proyeccionData = @json($proyeccionMensual->pluck('total'));

    new Chart(document.getElementById('masUsadosChart'), {
        type: 'bar',
        data: {
            labels: usadosLabels,
            datasets: [{
                label: 'Unidades utilizadas',
                data: usadosData,
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Componentes más utilizados' }
            }
        }
    });

    new Chart(document.getElementById('proyeccionChart'), {
        type: 'line',
        data: {
            labels: proyeccionLabels,
            datasets: [{
                label: 'Piezas requeridas',
                data: proyeccionData,
                borderColor: '#2a5bff',
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: { display: true, text: 'Proyección de Demanda Mensual' }
            }
        }
    });
</script>
</body>
</html>
