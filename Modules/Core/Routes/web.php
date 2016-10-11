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
		//------------------------------------------------
		//------------------------------------------------

	});


/*
|--------------------------------------------------------------------------
| Core Backend Routes
|--------------------------------------------------------------------------
*/