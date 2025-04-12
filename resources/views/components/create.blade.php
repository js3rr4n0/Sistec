<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Inventory Item</title>
    
    <a href="{{ route('dashboard') }}" class="btn">← Dashboard</a>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 2rem;
        }
        .container {
            background: white;
            padding: 2rem;
            max-width: 800px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 0.5rem;
        }
        .section {
            margin-bottom: 2rem;
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: bold;
            border-bottom: 1px solid #ccc;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 1rem;
        }
        input, select, textarea {
            width: 100%;
            padding: 0.6rem;
            margin-top: 0.3rem;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn {
            background: #2a5bff;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 1.5rem;
        }
        .btn:hover {
            background: #1e47cc;
        }
        .back-link {
            margin-top: 1rem;
            display: inline-block;
            text-decoration: none;
            color: #2a5bff;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Add New Inventory Item</h2>
    <p>Enter detailed information about the new item</p>

    <form method="POST" action="{{ route('components.store') }}">
        @csrf

        <!-- Basic Information -->
        <div class="section">
            <div class="section-title">Basic Information</div>

            <label for="nombre">Item Name *</label>
            <input type="text" name="nombre" id="nombre" required>

            <label for="tipo">Category / Type *</label>
            <input type="text" name="tipo" id="tipo" required>

            <label for="descripcion">Description</label>
            <textarea name="descripcion" rows="3"></textarea>
        </div>

        <!-- Inventory Details -->
        <div class="section">
            <div class="section-title">Inventory Details</div>

            <label for="stock">Initial Stock *</label>
            <input type="number" name="stock" id="stock" min="0" required>

            <label for="stock_minimo">Reorder Point</label>
            <input type="number" name="stock_minimo" min="0">

            <label for="ubicacion">Storage Location</label>
            <input type="text" name="ubicacion">
        </div>

       <!-- Optional Info -->
<div class="section">
    <div class="section-title">Additional Information</div>

    <label for="notas">Notes</label>
    <textarea name="notas" rows="3"></textarea>

    <label for="precio">Unit Price ($)</label>
    <input type="number" name="precio" step="0.01" min="0">
</div>

        <button class="btn" type="submit">Add Item</button>
    </form>

    <a href="{{ route('components.index') }}" class="back-link">&larr; Back to Inventory</a>
</div>
</body>
</html>
