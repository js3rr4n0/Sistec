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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .card {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .card h3 {
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }
        .card .stat {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .btn-group a,
        .btn-group button {
            background-color: #2a5bff;
            color: white;
            border: none;
            margin: 0.25rem;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
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
                <div class="stat">Total: {{ $totalCases }}</div>
                <div>Active: {{ $activeCases }} | Critical: {{ $criticalCases }} | Completed: {{ $completedCases }}</div>
                <div class="btn-group">
                    <a href="{{ route('cases.create') }}">Create Case</a>
                    <a href="{{ route('cases.index') }}">View Cases</a>
                    <button>Assign Technician</button>
                    <button>Case Analytics</button>
                </div>
            </div>

            <div class="card">
                <h3>Component Inventory</h3>
                <div class="stat">Items: {{ $totalItems }}</div>
                <div>Low Stock: {{ $lowStock }} | On Order: {{ $onOrder }}</div>
                <div>Value: ${{ number_format($inventoryValue, 2) }}</div>
                <div class="btn-group">
                    <button>Add Component</button>
                    <button>Check Stock</button>
                    <button>Order Parts</button>
                    <button>View History</button>
                </div>
            </div>

            <div class="card">
                <h3>Reports & Statistics</h3>
                <div class="stat">Reports: {{ $reports }}</div>
                <div>Insights: {{ $insights }} | Trends: {{ $trends }} | Alerts: {{ $alerts }}</div>
                <div class="btn-group">
                    <button>Generate Report</button>
                    <button>View Trends</button>
                    <button>Export Data</button>
                    <button>Custom Analysis</button>
                </div>
            </div>

            <div class="card">
                <h3>Decision Support</h3>
                <div class="stat">Savings: ${{ number_format($savings, 2) }}</div>
                <div>Recs: {{ $recommendations }} | Pending: {{ $pending }} | Impl: {{ $implemented }}</div>
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
