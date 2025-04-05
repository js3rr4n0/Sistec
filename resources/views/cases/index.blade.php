<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Cases | SISTEC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
        }
        header {
            background-color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
        }
        .logo img {
            height: 50px;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }
        .stats {
            display: flex;
            gap: 1.5rem;
        }
        .stat-box {
            background-color: #fff;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
            text-align: center;
        }
        .btn {
            background-color: #2a5bff;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        table {
            width: 100%;
            margin-top: 2rem;
            border-collapse: collapse;
        }
        th, td {
            border-bottom: 1px solid #ddd;
            padding: 0.75rem 1rem;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .filters {
            margin-top: 1rem;
            display: flex;
            gap: 1rem;
        }
        select, input[type="text"] {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="{{ asset('images/CAP.png') }}" alt="Logo SISTEC">
    </div>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('dashboard') }}" class="btn">← Dashboard</a>
        <a href="{{ route('cases.create') }}" class="btn">New Case</a>
    </div>
</header>


    <div class="topbar">
        <div class="stats">
            <div class="stat-box">
                <div>Total Cases</div>
                <strong>{{ $total }}</strong>
            </div>
            <div class="stat-box">
                <div>In Progress</div>
                <strong>{{ $inProgress }}</strong>
            </div>
            <div class="stat-box">
                <div>Critical Cases</div>
                <strong>{{ $critical }}</strong>
            </div>
            <div class="stat-box">
                <div>Completed</div>
                <strong>{{ $completed }}</strong>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="filters">
            <input type="text" placeholder="Search cases...">
            <select><option>All Status</option></select>
            <select><option>All Priority</option></select>
            <select><option>All Categories</option></select>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Case Details</th>
                    <th>Customer</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Last Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cases as $case)
                <tr>
                <td>
    <a href="{{ route('cases.show', $case->Id) }}" style="text-decoration: none; color: #2a5bff;">
        {{ $case->Titulo }}
    </a>
</td>
                    <td>{{ $case->cliente_nombre ?? 'Sin cliente' }}</td>
                    <td>{{ $case->tecnico_nombre ?? 'Unassigned' }}</td>
                    <td>{{ $case->Prioridad }}</td>
                    <td>{{ \Carbon\Carbon::parse($case->FechaSolicitud)->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
</body>
</html>
