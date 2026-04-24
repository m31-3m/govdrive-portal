<?php

namespace App\Providers;

use App\Models\ServiceRequest;
use App\Policies\ServiceRequestPolicy;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // FIX: This is how you manually link the Policy in Laravel 11
        Gate::policy(ServiceRequest::class, ServiceRequestPolicy::class);

        // Requirement: Gate for Admin-only parts of the UI
        Gate::define('admin-only', function (User $user) {
            return $user->role === 1;
        });
    }
}