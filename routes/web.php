<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('salvar_estudante', [App\Http\Controllers\EstudanteController::class, 'salvar_estudante']);
Route::get('visualizar_estudante', [App\Http\Controllers\EstudanteController::class, 'visualizar_estudante']);
Route::get('editar_estudante/{id}', [App\Http\Controllers\EstudanteController::class, 'editar_estudante']);
Route::put('atualizar_estudante', [App\Http\Controllers\EstudanteController::class, 'atualizar_estudante']);
Route::delete('deletar_estudante/{id}', [App\Http\Controllers\EstudanteController::class, 'deletar_estudante']);
