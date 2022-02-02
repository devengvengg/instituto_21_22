<?php

use App\Http\Controllers\API\CentroController;
use App\Http\Controllers\API\NivelController;

use App\Http\Controllers\API\falta_profesorController;

use App\Http\Controllers\API\GrupoController;
use App\Http\Controllers\API\TutorizadoController;

use App\Http\Controllers\API\MateriaController;

use App\Http\Controllers\API\MatriculaController;
use App\Http\Controllers\API\PeriodoLectivoController;
use App\Http\Controllers\API\MateriaMatriculadaController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config;

// AUTENTICACION:
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Autenticacion:
Route::post('/tokens/create', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    return response()->json([
        'token_type' => 'Bearer',
        'access_token' => $user->createToken('token_name')->plainTextToken // token name you can choose for your self or leave blank if you like to
    ]);
})->name('login');
// Proteger RUTA:
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::apiResource('centros', CentroController::class);
// Asegurarnos que el usuario este Autenticado:
Route::apiResource('centros', CentroController::class)->middleware('auth:sanctum');

Route::apiResource('matriculas', MatriculaController::class);
Route::apiResource('niveles', NivelController::class)
->parameters([
    'niveles' => 'nivel'
]);

Route::apiResource('faltas_profesores', falta_profesorController::class)
->parameters([
    'faltas_profesores' => 'falta_profesor'
]);

Route::apiResource('grupos', GrupoController::class);
Route::apiResource('tutorizados', TutorizadoController::class);
Route::apiResource('materias', MateriaController::class);
Route::apiResource('periodosLectivos', PeriodoLectivoController::class);
Route::apiResource('materiasmatriculadas', MateriaMatriculadaController::class)
->parameters([
    'materiasmatriculadas' => 'materiaMatriculada'

]);

// Sanctum:
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/{any}', function (ServerRequestInterface $request) {
    $config = new Config([
        'address' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'basePath' => '/api',
    ]);
    $api = new Api($config);
    $response = $api->handle($request);
    return $response;
})->where('any', '.*');


