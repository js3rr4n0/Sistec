<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\CaseController;

// Página de inicio
Route::get('/', function () {
    return view('landing');
});

// Página de login
Route::get('/login', function () {
    return view('login');
})->name('login');

// Procesa el formulario de login
Route::post('/login', function (Request $request) {
    $user = DB::table('users')->where('email', $request->email)->first();

    if ($user && $user->password === $request->password) {
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email
        ]);
        return redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Credenciales incorrectas',
    ]);
})->name('login.process');

// Registro de nuevo admin/técnico
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:4',
        'especialidad' => 'required|string|max:100',
    ]);

    $userId = DB::table('users')->insertGetId([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    DB::table('Tecnico')->insert([
        'Id' => uniqid(),
        'Nombre' => $request->name,
        'Especialidad' => $request->especialidad,
        'Email' => $request->email,
        'UserId' => $userId
    ]);

    session([
        'user_id' => $userId,
        'user_name' => $request->name,
        'user_email' => $request->email
    ]);

    return redirect('/dashboard');
})->name('register.process');

// Dashboard protegido
Route::get('/dashboard', function () {
    if (!session()->has('user_id')) {
        return redirect('/login');
    }

    $userName = session('user_name');
    $userEmail = session('user_email');

    $tecnico = DB::table('Tecnico')->where('Email', $userEmail)->first();

    if (!$tecnico) {
        return abort(403, 'No autorizado');
    }

    $totalCases = DB::table('casosoporte')->count();
    $completedCases = DB::table('seguimientocaso')->where('Estado', 'Finalizado')->count();
    $activeCases = $totalCases - $completedCases;
    $criticalCases = DB::table('casosoporte')->where('Prioridad', 'High')->count();

    $totalItems = DB::table('Componente')->count();
    $lowStock = DB::table('Componente')->where('Stock', '<', 10)->count();
    $onOrder = DB::table('MovimientoInventario')->where('TipoMovimiento', 'Orden')->count();
    $inventoryValue = DB::table('Componente')->sum(DB::raw('Stock * 100'));

    $reports = 24;
    $insights = 15;
    $trends = 8;
    $alerts = 5;

    $recommendations = 18;
    $pending = 7;
    $implemented = 11;
    $savings = 45000;

    return view('dashboard', compact(
        'userName',
        'totalCases', 'activeCases', 'criticalCases', 'completedCases',
        'totalItems', 'lowStock', 'onOrder', 'inventoryValue',
        'reports', 'insights', 'trends', 'alerts',
        'recommendations', 'pending', 'implemented', 'savings'
    ));
})->name('dashboard');

// Logout
Route::post('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logout');

// Crear nuevo caso
Route::get('/cases/create', function () {
    return view('create_case');
})->name('cases.create');

Route::post('/cases/store', function (Request $request) {
    if (!session()->has('user_id')) return redirect('/login');

    $tecnico = DB::table('tecnico')->where('UserId', session('user_id'))->first();
    if (!$tecnico) return abort(403, 'No autorizado');

    $clienteId = (string) Str::uuid();
    DB::table('cliente')->insert([
        'Id' => $clienteId,
        'Nombre' => $request->contactname,
        'Email' => $request->email,
        'Telefono' => $request->telefono
    ]);

    DB::table('casosoporte')->insert([
        'Id' => (string) Str::uuid(),
        'ClienteId' => $clienteId,
        'TecnicoId' => $tecnico->Id,
        'Titulo' => $request->titulo,
        'Descripcion' => $request->descripcion,
        'Prioridad' => $request->prioridad,
        'Categoria' => $request->categoria,
        'TipoDispositivo' => $request->tipodispositivo,
        'SerialNumber' => $request->serialnumber,
        'FechaCompra' => $request->fechacompra,
        'Sintomas' => $request->sintomas,
        'MetodoContacto' => $request->metodocontacto,
        'NotasAdicionales' => $request->notasadicionales,
        'RelacionConCasoPrevio' => $request->has('relacioncasoprevio') ? 1 : 0,
        'FechaSolicitud' => now()
    ]);

    return redirect()->route('cases.index')->with('success', 'Caso de soporte creado correctamente.');
})->name('cases.store');

// Listado, asignación y detalle de casos
Route::get('/cases/assign', [CaseController::class, 'assignView'])->name('cases.assign');
Route::post('/cases/assign/save', [CaseController::class, 'bulkAssign'])->name('cases.assign.save');
Route::get('/cases', [CaseController::class, 'index'])->name('cases.index');
Route::get('/cases/{id}', [CaseController::class, 'show'])->name('cases.show');
Route::post('/cases/{id}/update', [CaseController::class, 'update'])->name('cases.update');
Route::post('/cases/assign/bulk', [CaseController::class, 'bulkAssign'])->name('cases.assign.bulk');
Route::get('/components', function () {
    $components = DB::table('componente')
        ->select('Id', 'Nombre', 'Tipo', 'Stock', 'stock_minimo', 'descripcion', 'ubicacion')
        ->orderBy('Nombre')
        ->get();

    return view('components.index', compact('components'));
})->name('components.index');

// Formulario para crear componente
Route::get('/components/create', function () {
    return view('components.create');
})->name('components.create');

// Almacenar nuevo componente
Route::post('/components/store', function (Request $request) {
    DB::table('componente')->insert([
        'Id' => (string) Str::uuid(),
        'Nombre' => $request->nombre,
        'Tipo' => $request->tipo,
        'Stock' => $request->stock,
        'stock_minimo' => $request->stock_minimo ?? 10,
        'descripcion' => $request->descripcion,
        'ubicacion' => $request->ubicacion,
        'notas' => $request->notas,
        'precio' => $request->precio ?? 0,
    ]);

    return redirect()->route('components.index')->with('success', 'Componente añadido.');
})->name('components.store');
// Formulario de movimientos
Route::get('/movimientos/inventario', function () {
    $componentes = DB::table('componente')->get();
    return view('components.movimiento', compact('componentes'));
})->name('movimientos.form');

// Procesar entrada o salida
Route::post('/movimientos/inventario', function (Request $request) {
    $request->validate([
        'componente_id' => 'required',
        'tipo_movimiento' => 'required|in:entrada,salida',
        'cantidad' => 'required|integer|min:1',
        'notas' => 'nullable|string'
    ]);

    $componente = DB::table('componente')->where('Id', $request->componente_id)->first();

    if (!$componente) {
        return back()->withErrors(['componente_id' => 'Componente no encontrado.']);
    }

    if ($request->tipo_movimiento === 'salida' && $request->cantidad > $componente->Stock) {
        return back()->withErrors(['cantidad' => 'No puedes retirar más de lo disponible. Stock actual: ' . $componente->Stock]);
    }

    // Ajustar stock
    $nuevoStock = $request->tipo_movimiento === 'entrada'
        ? $componente->Stock + $request->cantidad
        : $componente->Stock - $request->cantidad;

    DB::table('componente')->where('Id', $request->componente_id)->update([
        'Stock' => $nuevoStock
    ]);

    // Registrar movimiento
    DB::table('movimiento_inventario')->insert([
        'Id' => (string) Str::uuid(),
        'ComponenteId' => $request->componente_id,
        'TipoMovimiento' => $request->tipo_movimiento,
        'Cantidad' => $request->cantidad,
        'Notas' => $request->notas,
        'FechaMovimiento' => now()
    ]);

    return redirect()->route('components.index')->with('success', 'Movimiento registrado correctamente.');
})->name('movimientos.store');