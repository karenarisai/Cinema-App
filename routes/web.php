<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\adminController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('settings/two-factor', TwoFactor::class)
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    Route::get('sucursales',[adminController::class,'index'])->name('sucursales.index');
    Route::post('sucursales/save',[adminController::class,'save'])->name('sucursales.save');
    Route::post('sucursales/delete/{id}',[adminController::class,'delete'])->name('sucursales.delete');
    Route::get('sucursales/show/{id}',[adminController::class,'show'])->name('sucursales.show');
    Route::post('sucursales/update/{id}',[adminController::class,'update'])->name('sucursales.update');
    Route::get('salas/index',[adminController::class,'indexSalas'])->name('salas.index');
    Route::post('salas/save',[adminController::class,'saveSalas'])->name('salas.save');
    Route::get('peliculas/index',[adminController::class,'indexPeliculas'])->name('peliculas.index');
    Route::post('peliculas/save',[adminController::class,'savePeliculas'])->name('peliculas.save');
    Route::get('peliculas/show/{id}',[adminController::class,'showPelicula'])->name('peliculas.show');
    Route::post('peliculas/update/{id}',[adminController::class,'updatePeliculas'])->name('peliculas.update');
    Route::post('peliculas/delete/{id}',[adminController::class,'deletePelicula'])->name('peliculas.delete');
});

require __DIR__.'/auth.php';
