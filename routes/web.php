<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovimentacaoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Rotas do sistema
Route::get('/dashboard', [MovimentacaoController::class, 'dashboard'])->name('dashboard');
Route::get('/movimentacoes', [MovimentacaoController::class, 'index'])->name('movimentacoes.index');
Route::get('/movimentacoes/nova', [MovimentacaoController::class, 'create'])->name('movimentacoes.create');
Route::post('/movimentacoes/store', [MovimentacaoController::class, 'store'])->name('movimentacoes.store');

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
