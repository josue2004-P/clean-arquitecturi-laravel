<?php

namespace App\Contexts\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use App\Contexts\Dashboard\Presentation\Livewire\DashboardPage;

class DashboardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        View::addNamespace('dashboard', __DIR__ . '/../Presentation/Views');

        Livewire::component('dashboard.dashboard-page', DashboardPage::class);
    }
}