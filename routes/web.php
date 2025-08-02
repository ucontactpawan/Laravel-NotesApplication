<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\welcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('notes.index');
});

Route::resource('notes', NotesController::class);
