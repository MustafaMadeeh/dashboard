<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
 


Route::get('/', function () {
    return view('projects');
})->middleware(['auth', 'verified'])->name('dashboard');



// Route::get('/dashboard', function () {
//     return view('projects');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/projects', function () {
    return view('projects');
})->middleware(['auth', 'verified'])->name('projects');




Route::get('/apidoc', function () {
    return view('apiDoc');
})->name('apidoc');

Route::middleware('auth')->group(function () {
 

    Route::get('projectdata/{id}', [ProjectController::class, 'show'])->name('project.show');
    
 

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
