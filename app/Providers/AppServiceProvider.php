<?php

namespace App\Providers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ------------------------------
        // GATES
        // ------------------------------

        // Define a gate that checks if the user is admin
        Gate::define('admin', function(){
            return Auth::user()->role === 'admin';
        });
        // Define a gate that checks if the user is rh colaborator
        Gate::define('rh', function(){
            return Auth::user()->role === 'rh';
        });
        // Define a gate that checks if the user is colaborator
        Gate::define('colaborator', function(){
            return Auth::user()->role === 'colaborator';
        });
         // Define a gate that checks if the user is lider
         Gate::define('lider', function(){
            return Auth::user()->role === 'lider';
        });
         // Define a gate that checks if the user is revendedora
         Gate::define('vende', function(){
            return Auth::user()->role === 'vende';
        });
        // Define a gate that checks if the user is Client
        Gate::define('client', function(){
            return Auth::user()->role === 'client';
        });
        
            
            
        
    }
}