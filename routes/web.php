<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Contexts\Dashboard\Presentation\Livewire\DashboardPage;

use App\Contexts\Public\Presentation\Livewire\WelcomePage;
use App\Contexts\Public\Presentation\Livewire\ContactPage;

use App\Contexts\Security\Presentation\Livewire\Permisos\IndexPermisos;
use App\Contexts\Security\Presentation\Livewire\Permisos\CreatePermiso;
use App\Contexts\Security\Presentation\Livewire\Permisos\EditPermiso;

use App\Contexts\Security\Presentation\Livewire\Perfiles\IndexPerfiles;
use App\Contexts\Security\Presentation\Livewire\Perfiles\CreatePerfil;
use App\Contexts\Security\Presentation\Livewire\Perfiles\EditPerfil;

use App\Contexts\Security\Presentation\Livewire\Usuarios\IndexUsuarios;
use App\Contexts\Security\Presentation\Livewire\Usuarios\CreateUsuario;
use App\Contexts\Security\Presentation\Livewire\Usuarios\EditUsuario;

use App\Contexts\Security\Presentation\Livewire\Profile\EditProfilePage;


Route::get('/', WelcomePage::class)->name('home');
Route::get('/contacto', ContactPage::class)->name('contactar');

Route::middleware(['auth'])->group(function () {

    // --- MÓDULO PERMISOS ---
    Route::get('permisos', IndexPermisos::class)->name('permisos.index');
    Route::get('permisos/crear', CreatePermiso::class)->name('permisos.create');
    Route::get('permisos/{id}/editar', EditPermiso::class)->name('permisos.edit');

    // MODULO PERFILES
    Route::get('perfiles', IndexPerfiles::class)->name('perfiles.index');
    Route::get('perfiles/crear', CreatePerfil::class)->name('perfiles.create');
    Route::get('perfiles/{id}/editar', EditPerfil::class)->name('perfiles.edit');

    // MODULO USUARIOS
    Route::get('usuarios', IndexUsuarios::class)->name('usuarios.index');
    Route::get('usuarios/crear', CreateUsuario::class)->name('usuarios.create');
    Route::get('usuarios/{id}/editar', EditUsuario::class)->name('usuarios.edit');
});

Route::get('/dashboard', DashboardPage::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', EditProfilePage::class)->name('profile.edit');
});

require __DIR__.'/auth.php';
