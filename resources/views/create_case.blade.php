<!-- resources/views/create_case.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Support Request</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 2rem;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-container h2 {
            margin-bottom: 1rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.3rem;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 0.5rem;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .priority-options label {
            margin-right: 1rem;
        }
        .symptoms span {
            display: inline-block;
            background: #eee;
            padding: 0.4rem 0.6rem;
            margin: 0.2rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .methods input {
            margin-right: 5px;
        }
        .actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1.5rem;
        }
        .btn {
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 0.5rem;
        }
        .btn-submit {
            background-color: #2a5bff;
            color: white;
        }
        .btn-cancel {
            background-color: #ccc;
        }
    </style>
</head>
<body>
<div class="form-container">
    <img src="{{ asset('images/CAP.png') }}" alt="Logo" style="height: 60px; margin-bottom: 1rem;">
    <h2>New Support Request</h2>
    <form method="POST" action="{{ route('cases.store') }}">
        @csrf
        <div class="form-group">
            <label>Issue Title</label>
            <input type="text" name="titulo" required>
        </div>
        <div class="form-group">
            <label>Priority</label>
            <div class="priority-options">
                <label><input type="radio" name="prioridad" value="Low" checked> <span style="color:green">●</span> Low</label>
                <label><input type="radio" name="prioridad" value="Medium"> <span style="color:orange">●</span> Medium</label>
                <label><input type="radio" name="prioridad" value="High"> <span style="color:red">●</span> High</label>
            </div>
        </div>
        <div class="form-group">
            <label>Issue Description</label>
            <textarea name="descripcion" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <input type="text" name="categoria">
        </div>
        <div class="form-group">
            <label>Device Type</label>
            <input type="text" name="tipodispositivo">
        </div>
        <div class="form-group">
            <label>Serial Number</label>
            <input type="text" name="serialnumber">
        </div>
        <div class="form-group">
            <label>Purchase Date</label>
            <input type="date" name="fechacompra">
        </div>
        <div class="form-group">
            <label>Common Symptoms</label>
            <textarea name="sintomas" placeholder="Example: Won't Power On, Slow Performance"></textarea>
        </div>
        <div class="form-group">
            <label>Contact Name</label>
            <input type="text" name="contactname">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="telefono">
        </div>
        <div class="form-group">
            <label>Preferred Contact Method</label>
            <div class="methods">
                <label><input type="radio" name="metodocontacto" value="Email" checked> Email</label>
                <label><input type="radio" name="metodocontacto" value="Phone"> Phone</label>
            </div>
        </div>
        <div class="form-group">
            <label>Additional Notes</label>
            <textarea name="notasadicionales" rows="2"></textarea>
        </div>
        <div class="form-group">
            <label><input type="checkbox" name="relacioncasoprevio" value="1"> I have previous cases related to this issue</label>
        </div>
        <div class="actions">
            <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
            <button type="submit" class="btn btn-submit">Submit Request</button>
        </div>
    </form>
</div>
</body>
</html>
