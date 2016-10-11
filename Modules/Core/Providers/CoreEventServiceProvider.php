<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Observers\RoleObserver;
use Modules\Core\Observers\UserObserver;
use Modules\Core\Entities\User;
use Modules\Core\Entities\Role;

class CoreEventServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

	public function boot()
	{
		User::observe(UserObserver::class);
		Role::observe(RoleObserver::class);
	}

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
