<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Technician</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            padding: 2rem;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 1rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        th, td {
            padding: 0.75rem;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
        select {
            padding: 0.35rem;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .btn {
            background-color: #2a5bff;
            color: white;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .message {
            color: green;
            margin-bottom: 1rem;
        }

        /* Paginación compacta */
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding-left: 0;
            gap: 0.4rem;
            margin-top: 2rem;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination li a,
        .pagination li span {
            font-size: 0.8rem;
            padding: 0.3rem 0.55rem;
            border: 1px solid #2a5bff;
            border-radius: 5px;
            text-decoration: none;
            color: #2a5bff;
            background-color: #fff;
        }

        .pagination li a:hover {
            background-color: #2a5bff;
            color: #fff;
        }

        .pagination li.active span {
            background-color: #2a5bff;
            color: white;
            font-weight: bold;
        }

        .pagination li.disabled span {
            background-color: #eee;
            color: #888;
            border-color: #ccc;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Assign Technicians to Cases</h2>

    @if (session('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('cases.assign.bulk') }}">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Case Title</th>
                    <th>Current Technician</th>
                    <th>Assign New Technician</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cases as $case)
                    <tr>
                        <td>{{ $case->Titulo ?? '[No Title]' }}</td>
                        <td>{{ $case->tecnico_nombre ?? 'Unassigned' }}</td>
                        <td>
                            <select name="assignments[{{ $case->Id }}]">
                                <option value="">-- Select Technician --</option>
                                @foreach ($tecnicos as $tec)
                                    <option value="{{ $tec->Id }}" {{ $case->TecnicoId === $tec->Id ? 'selected' : '' }}>
                                        {{ $tec->Nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn" type="submit">Save Assignments</button>
    </form>

    {{-- Paginación --}}
    <div>
        {{ $cases->links('pagination::default') }}
    </div>

    <div style="margin-top: 1rem;">
        <a href="{{ route('dashboard') }}" style="text-decoration:none; color:#2a5bff;">← Back to Dashboard</a>
    </div>
</div>
</body>
</html>
