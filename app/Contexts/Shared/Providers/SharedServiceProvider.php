<?php

namespace App\Contexts\Shared\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
    }
}