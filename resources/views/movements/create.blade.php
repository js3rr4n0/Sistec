<!-- resources/views/movements/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Movement</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f6fa;
            padding: 2rem;
        }
        .container {
            background: #fff;
            padding: 2rem;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.3rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn {
            margin-top: 1.5rem;
            background: #2a5bff;
            color: white;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .alert {
            background-color: #ffdddd;
            color: #d8000c;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 5px solid red;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Register Inventory Movement</h2>

    @if (session('error'))
        <div class="alert">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('movements.store') }}">
        @csrf

        <label for="componente_id">Component</label>
        <select name="componente_id" required>
            <option value="">-- Select Component --</option>
            @foreach($components as $comp)
                <option value="{{ $comp->Id }}">{{ $comp->Nombre }} (Stock: {{ $comp->Stock }})</option>
            @endforeach
        </select>

        <label for="tipo">Movement Type</label>
        <select name="tipo" required>
            <option value="Entrada">Entrada</option>
            <option value="Salida">Salida</option>
        </select>

        <label for="cantidad">Quantity</label>
        <input type="number" name="cantidad" min="1" required>

        <label for="notas">Notes</label>
        <textarea name="notas" rows="3"></textarea>

        <button type="submit" class="btn">Register Movement</button>
    </form>
</div>
</body>
</html>
