<?php

use App\Http\Controllers\API\CentroController;
use App\Http\Controllers\API\NivelController;
use App\Http\Controllers\API\TutorizadoController;
use App\Http\Controllers\API\MateriaController;
use App\Http\Controllers\API\MatriculaController;
use App\Http\Controllers\API\PeriodoLectivoController;
use App\Http\Controllers\API\MateriaMatriculadaController;
use App\Http\Controllers\API\Peticion_InformacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config;

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

Route::apiResource('centros', CentroController::class);

Route::apiResource('matriculas', MatriculaController::class);

Route::apiResource('niveles', NivelController::class)
->parameters([
    'niveles' => 'nivel'
]);


Route::apiResource('tutorizados', TutorizadoController::class);


Route::apiResource('materias', MateriaController::class);
Route::apiResource('periodosLectivos', PeriodoLectivoController::class);
Route::apiResource('materiasmatriculadas', MateriaMatriculadaController::class)
->parameters([
    'materiasmatriculadas' => 'materiaMatriculada'
]);

Route::apiResource('peticiones_informacion', Peticion_InformacionController::class)
->parameters([
    'peticiones_informacion' => 'Peticion_InformacionController'
]);

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
