<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reportes de Fallas | SISTEC</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4C+XJf9sK0fK0eM9Fy3u3C9lH4FZtN7Zqk5zgYcG9PLU5qUjR9VnL3rAGMUKR1emxZ8OA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        canvas {
            max-width: 100%;
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
        <h1>Reportes de Fallas Comunes</h1>
        <button class="btn-export" onclick="window.print()"><i class="fas fa-file-pdf"></i> Exportar a PDF</button>
    </header>
    <div class="container">
        <div class="chart-box">
            <h3>Fallas más comunes (por Categoría)</h3>
            <canvas id="categoriaChart"></canvas>
        </div>
        <div class="chart-box">
            <h3>Fallas más comunes por Tipo de Dispositivo</h3>
            <canvas id="dispositivoChart"></canvas>
        </div>
    </div>

    <script>
        const categoriaLabels = @json(array_keys($fallasPorCategoria));
        const categoriaData = @json(array_values($fallasPorCategoria));

        const dispositivoLabels = @json(array_keys($fallasPorDispositivo));
        const dispositivoData = @json(array_values($fallasPorDispositivo));

        new Chart(document.getElementById('categoriaChart'), {
            type: 'bar',
            data: {
                labels: categoriaLabels,
                datasets: [{
                    label: 'Cantidad de Fallas',
                    data: categoriaData,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Fallas por Categoría' }
                }
            }
        });

        new Chart(document.getElementById('dispositivoChart'), {
            type: 'pie',
            data: {
                labels: dispositivoLabels,
                datasets: [{
                    label: 'Cantidad de Fallas',
                    data: dispositivoData,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: 'Fallas por Tipo de Dispositivo' }
                }
            }
        });
    </script>
</body>
</html>
