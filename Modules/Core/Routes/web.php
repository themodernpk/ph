<?php


/*
|--------------------------------------------------------------------------
| Core Frontend Routes
|--------------------------------------------------------------------------
*/

Route::group(
	[
		'middleware' => ['web', 'core.frontend'],
        'prefix' => 'core',
        'namespace' => 'Modules\Core\Http\Controllers'
	],
	function()
	{
	    Route::get('/', 'UserController@index')
		    ->name('core.frontend.login')
		    ->middleware(['core.frontend.login']);
		//------------------------------------------------
		Route::get('/register', 'UserController@register')
			->name('core.frontend.register')
			->middleware(['core.frontend.register']);
		//------------------------------------------------
		Route::any('/register/store', 'UserController@store')
		     ->name('core.frontend.register.store')
		     ->middleware(['core.frontend.register']);
		//------------------------------------------------
		Route::any('/authenticate', 'AuthController@login')
		     ->name('core.frontend.authenticate')
		     ->middleware(['core.frontend.login']);
		//------------------------------------------------
		Route::any('/modules/sync/db', 'CoreController@modulesSyncWithDb')
		     ->name('core.backend.modules.sync');
		//------------------------------------------------
		//------------------------------------------------
		Route::get('/logout', 'AuthController@logout')
		     ->name('core.backend.logout')
			->middleware(['core.backend']);
		//------------------------------------------------
		//------------------------------------------------
		//------------------------------------------------

	});

/*
|--------------------------------------------------------------------------
| Core Backend Logout
|--------------------------------------------------------------------------
*/

Route::group(
	[
		'middleware' => ['web', 'core.backend'],
		'prefix' => 'core/backend',
		'namespace' => 'Modules\Core\Http\Controllers'
	],
	function()
	{
		//------------------------------------------------
		Route::get('/logout', 'AuthController@logout')
		     ->name('core.backend.logout');
		//------------------------------------------------
	});

/*
|--------------------------------------------------------------------------
| Core Backend Routes
|--------------------------------------------------------------------------
*/

Route::group(
	[
		'middleware' => ['web', 'core.backend'],
		'prefix' => 'core/backend',
		'namespace' => 'Modules\Core\Http\Controllers\Backend'
	],
	function()
	{
		Route::get('/dashboard', 'DashboardController@index')
		     ->name('core.backend.dashboard');
		//------------------------------------------------

		//------------------------------------------------
		//------------------------------------------------
		//------------------------------------------------

	});