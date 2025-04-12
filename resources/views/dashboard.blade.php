<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | SISTEC</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
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

        .welcome {
            font-size: 1rem;
        }

        .container {
            padding: 2rem;
        }

        h1 {
            margin-top: 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 1.8rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 1.5rem;
            color: #2a5bff;
            margin-bottom: 0.5rem;
        }

        .card p {
            color: #555;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .stats {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.2rem;
        }

        .stats div {
            background-color: #f0f4ff;
            color: #333;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .btn-group a, .btn-group button {
            background-color: #e6f0ff;
            color: #2a5bff;
            border: 1px solid #2a5bff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s ease-in-out;
        }

        .btn-group a:hover, .btn-group button:hover {
            background-color: #2a5bff;
            color: white;
        }

        footer {
            text-align: center;
            margin-top: 3rem;
            font-size: 0.85rem;
            color: #999;
        }

        button {
            font-family: inherit;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="{{ asset('images/CAP.png') }}" alt="Logo SISTEC">
    </div>
    <div class="user-info" style="display:flex; align-items:center; gap:1rem; background:#f0f4ff; padding:0.6rem 1rem; border-radius:10px;">
        <img src="https://wallpapers.com/images/hd/placeholder-profile-icon-20tehfawxt5eihco.jpg" alt="Profile Picture" style="height:45px; width:45px; border-radius:50%; object-fit:cover;">
        <div style="display:flex; flex-direction:column;">
            <span style="font-weight:bold;">{{ $userName }}</span>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" style="background:none; border:none; color:#2a5bff; font-weight:bold; cursor:pointer; font-size:0.85rem;">Logout</button>
            </form>
        </div>
    </div>
</header>


<div class="container">
    <h1>Service Management Hub</h1>
    <p>Select a module to manage your service operations:</p>

    <div class="grid">

        {{-- Technical Support Card --}}
        <div class="card">
            <h3>🛠 Technical Support</h3>
            <p>Manage service requests, track cases, and assign technicians efficiently.</p>
            <div class="stats">
                <div>Total Cases: {{ $totalCases }}</div>
                <div>Active: {{ $activeCases }}</div>
                <div>Critical: {{ $criticalCases }}</div>
                <div>Completed: {{ $completedCases }}</div>
            </div>
            <div class="btn-group">
                <a href="{{ route('cases.create') }}">+ Create Case</a>
                <a href="{{ route('cases.index') }}">📋 View Cases</a>
                <a href="{{ route('cases.assign') }}">👨‍🔧 Assign Technician</a>
            </div>
        </div>

        {{-- Component Inventory Card --}}
        <div class="card">
            <h3>📦 Component Inventory</h3>
            <p>Track and manage all components, monitor stock, and process inventory movement.</p>
            <div class="stats">
                <div>Total Items: {{ $totalItems }}</div>
                <div>Low Stock: {{ $lowStock }}</div>
                <div>Value: ${{ number_format($inventoryValue / 2, 2) }}</div>
            </div>
            <div class="btn-group">
                <a href="{{ route('components.create') }}">+ Add Component</a>
                <a href="{{ route('components.index') }}">📊 Check Stock</a>
                <a href="{{ route('movimientos.registro') }}">🔄 Inventory Movement</a>
            </div>
        </div>

        {{-- Reports Card --}}
        <div class="card">
            <h3>📈 Reports & Statistics</h3>
            <p>Review trends, visualize failure types, and component usage statistics.</p>
            <div class="btn-group">
                <a href="{{ route('reportes.index') }}">📊 Fallas Report</a>
                <a href="{{ route('componentes.reporte') }}">🧩 Component Report</a>
            </div>
        </div>

        {{-- Decision Support Card --}}
        <div class="card">
            <h3>🧠 Decision Support</h3>
            <p>Forecast demand and receive suggestions for component reorders.</p>
            <div class="btn-group">
                <a href="{{ route('componentes.sugerencias') }}">📦 Purchase Suggestions</a>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 SISTEC - All rights reserved.
    </footer>
</div>
</body>
</html>
