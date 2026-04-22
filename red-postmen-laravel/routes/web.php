<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    Route::get('my-points', function () {
        return Inertia::render('my-points');
    })->name('my-points');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
