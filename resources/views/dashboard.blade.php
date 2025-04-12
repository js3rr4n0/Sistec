<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | SISTEC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 2rem;
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
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .card {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .card h3 {
            margin-bottom: 0.5rem;
            font-size: 1.4rem;
        }
        .card p {
            color: #555;
            margin-bottom: 1rem;
        }
        .stats {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        .stats div {
            background-color: #f0f4ff;
            padding: 0.75rem 1.25rem;
            border-radius: 6px;
            margin: 0.25rem;
            font-weight: bold;
        }
        .btn-group a, .btn-group button {
            background-color: #e6f0ff;
            color: #2a5bff;
            border: 1px solid #2a5bff;
            margin: 0.25rem;
            padding: 0.4rem 0.9rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
        }
        .btn-group a:hover, .btn-group button:hover {
            background-color: #2a5bff;
            color: white;
        }
        footer {
            text-align: center;
            margin-top: 3rem;
            font-size: 0.85rem;
            color: #888;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="{{ asset('images/CAP.png') }}" alt="Logo SISTEC">
    </div>
    <div class="welcome">
        Welcome, {{ $userName }}
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</header>

<div class="container">
    <h1>Service Management Hub</h1>
    <p>Select a module to manage your service operations</p>

    <div class="grid">
        <div class="card">
            <h3>Technical Support</h3>
            <p>Manage service requests, track cases, and assign technicians</p>
            <div class="stats">
                <div>Total Cases: {{ $totalCases }}</div>
                <div>Active: {{ $activeCases }}</div>
                <div>Critical: {{ $criticalCases }}</div>
                <div>Completed: {{ $completedCases }}</div>
            </div>
            <div class="btn-group">
                <a href="{{ route('cases.create') }}">Create Case</a>
                <a href="{{ route('cases.index') }}">View Cases</a>
                <a href="{{ route('cases.assign') }}">Assign Technician</a>
                <button>Case Analytics</button>
            </div>
        </div>

        <div class="card">
            <h3>Component Inventory</h3>
            <p>Track parts, manage stock levels, and handle procurement</p>
            <div class="stats">
                <div>Total Items: {{ $totalItems }}</div>
                <div>Low Stock: {{ $lowStock }}</div>
                <div>On Order: {{ $onOrder }}</div>
                <div>Value: ${{ number_format($inventoryValue, 2) }}</div>
            </div>
            <div class="btn-group">
            <a href="{{ route('components.create') }}">Add Component</a>
            <a href="{{ route('components.index') }}">Check Stock</a>
            <a href="{{ route('movimientos.form') }}" class="btn">Inventory Movement</a>
                <button>View History</button>
            </div>
        </div>

        <div class="card">
            <h3>Reports & Statistics</h3>
            <p>Analytics, trends, and performance metrics</p>
            <div class="stats">
                <div>Reports: {{ $reports }}</div>
                <div>Insights: {{ $insights }}</div>
                <div>Trends: {{ $trends }}</div>
                <div>Alerts: {{ $alerts }}</div>
            </div>
            <div class="btn-group">
                <button>Generate Report</button>
                <button>View Trends</button>
                <button>Export Data</button>
                <button>Custom Analysis</button>
            </div>
        </div>

        <div class="card">
            <h3>Decision Support</h3>
            <p>Resource optimization and procurement strategies</p>
            <div class="stats">
                <div>Recs: {{ $recommendations }}</div>
                <div>Pending: {{ $pending }}</div>
                <div>Impl: {{ $implemented }}</div>
                <div>Savings: ${{ number_format($savings, 2) }}</div>
            </div>
            <div class="btn-group">
                <button>View Insights</button>
                <button>Resource Planning</button>
                <button>Cost Analysis</button>
                <button>Optimization</button>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 SISTEC - All rights reserved.
    </footer>
</div>
</body>
</html>
