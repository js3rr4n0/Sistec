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
        select, button {
            padding: 0.4rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn {
            background-color: #2a5bff;
            color: white;
            font-weight: bold;
            padding: 0.4rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .message {
            color: green;
            margin-bottom: 1rem;
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
                                    <option value="{{ $tec->Id }}" {{ $case->TecnicoId === $tec->Id ? 'selected' : '' }}>{{ $tec->Nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn" type="submit">Save Assignments</button>
    </form>

    <div style="margin-top: 1rem;">
        <a href="{{ route('dashboard') }}" style="text-decoration:none; color:#2a5bff;">← Back to Dashboard</a>
    </div>
</div>
</body>
</html>
