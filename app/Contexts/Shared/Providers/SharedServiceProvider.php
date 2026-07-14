<?php

namespace App\Contexts\Shared\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Livewire; 

// ASENTAMIENTOS
use App\Contexts\Shared\Presentation\Livewire\Asentamientos\IndexAsentamientos;
use App\Contexts\Shared\Presentation\Livewire\Asentamientos\CreateAsentamiento;
use App\Contexts\Shared\Presentation\Livewire\Asentamientos\EditAsentamiento;

class SharedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        View::addNamespace('shared', __DIR__ . '/../Presentation/Views');

        $this->callAfterResolving(\Illuminate\View\Compilers\BladeCompiler::class, function ($blade) {
            $blade->componentNamespace(__DIR__ . '/../Presentation/Views/components', 'shared');
        });

        // ASENTAMIENTOS
        Livewire::component('shared::asentamientos.index-asentamientos', IndexAsentamientos::class);
        Livewire::component('shared::asentamientos.create-asentamiento', CreateAsentamiento::class);
        Livewire::component('shared::asentamientos.edit-asentamiento', EditAsentamiento::class);

        $this->app->bind(
            \App\Contexts\Shared\Domain\Repositories\AsentamientoRepositoryInterface::class,
            \App\Contexts\Shared\Infrastructure\Repositories\EloquentAsentamientoRepository::class
        );
    }
}