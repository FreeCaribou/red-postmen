<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AreaController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
    Route::get('my-postmen', function () {
        return Inertia::render('my-postmen');
    })->name('my-postmen');
    Route::get('my-areas', [AreaController::class, 'getAll'])->name('my-areas');
    Route::get('my-areas/new-area', function () {
        return Inertia::render('new-area');
    })->name('new-area');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
