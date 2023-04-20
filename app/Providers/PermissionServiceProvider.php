<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Permission::all()->map(function($permission){
 
            Gate::define($permission->name, function(User $user) use ($permission){
                return $user->hasPermissions($permission);
            });
            
        });
    }
}