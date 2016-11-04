<?php
/*
|--------------------------------------------------------------------------
| Core Frontend Routes
|--------------------------------------------------------------------------
*/
Route::group(
	[
		'middleware' => [ 'web', 'core.frontend' ],
		'prefix'     => 'core',
		'namespace'  => 'Modules\Core\Http\Controllers'
	],
	function () {
		Route::get( '/', 'UserController@index' )
		     ->name( 'core.frontend.login' )
		     ->middleware( [ 'core.frontend.login' ] );
		//------------------------------------------------
		Route::get( '/register', 'UserController@register' )
		     ->name( 'core.frontend.register' )
		     ->middleware( [ 'core.frontend.register' ] );
		//------------------------------------------------
		Route::get( '/ui', 'CoreController@ui' )
		     ->name( 'core.frontend.ui' );
		//------------------------------------------------
		Route::get( '/test', 'CoreController@test' )
		     ->name( 'core.frontend.test' );
		//------------------------------------------------
		Route::any( '/register/store', 'UserController@store' )
		     ->name( 'core.frontend.register.store' )
		     ->middleware( [ 'core.frontend.register' ] );
		//------------------------------------------------
		Route::any( '/authenticate', 'AuthController@login' )
		     ->name( 'core.frontend.authenticate' )
		     ->middleware( [ 'core.frontend.login' ] );
		//------------------------------------------------
		Route::any( '/modules/sync/db', 'CoreController@modulesSyncWithDb' )
		     ->name( 'core.backend.modules.sync' );
		//------------------------------------------------
		//------------------------------------------------
		Route::get( '/logout', 'AuthController@logout' )
		     ->name( 'core.backend.logout' )
		     ->middleware( [ 'core.backend' ] );
		//------------------------------------------------
		//------------------------------------------------
		//------------------------------------------------
	} );
/*
|--------------------------------------------------------------------------
| Core Backend Logout
|--------------------------------------------------------------------------
*/
Route::group(
	[
		'middleware' => [ 'web', 'core.backend' ],
		'prefix'     => 'core/backend',
		'namespace'  => 'Modules\Core\Http\Controllers'
	],
	function () {
		//------------------------------------------------
		Route::get( '/logout', 'AuthController@logout' )
		     ->name( 'core.backend.logout' );
		//------------------------------------------------
	} );
/*
|--------------------------------------------------------------------------
| Core Backend Routes
|--------------------------------------------------------------------------
*/
Route::group(
	[
		'middleware' => [ 'web', 'core.backend' ],
		'prefix'     => 'core/backend',
		'namespace'  => 'Modules\Core\Http\Controllers'
	],
	function () {
		Route::get( '/dashboard', 'DashboardController@index' )
		     ->name( 'core.backend.dashboard' );
		//############# Permission #################################
		Route::get( '/permissions', 'PermissionsController@index' )
		     ->name( 'core.backend.permissions' );
		//------------------------------------------------
		Route::get( '/permissions/list', 'PermissionsController@getList' )
		     ->name( 'core.backend.permissions.list' );
		//------------------------------------------------
		Route::post( '/permissions/toggle', 'PermissionsController@toggle' )
		     ->name( 'core.backend.permissions.toggle' );
		//------------------------------------------------
		Route::any( '/permissions/read/{id}', 'PermissionsController@read' )
		     ->name( 'core.backend.permissions.read' );
		//############# Role #################################
		//------------------------------------------------
		Route::get( '/roles', 'RolesController@index' )
		     ->name( 'core.backend.roles' );
		//------------------------------------------------
		Route::get( '/roles/list', 'RolesController@getList' )
		     ->name( 'core.backend.roles.list' );
		//------------------------------------------------
		Route::any( '/roles/toggle', 'RolesController@toggle' )
		     ->name( 'core.backend.roles.toggle' );
		//------------------------------------------------
		Route::post( '/roles/store', 'RolesController@store' )
		     ->name( 'core.backend.roles.store' );
		//------------------------------------------------
		Route::any( '/roles/delete/{id}', 'RolesController@delete' )
		     ->name( 'core.backend.roles.delete' );
		//------------------------------------------------
		Route::any( '/roles/restore/{id}', 'RolesController@restore' )
		     ->name( 'core.backend.roles.restore' );
		//------------------------------------------------
		Route::any( '/roles/delete/permanent/{id}', 'RolesController@deletePermanent' )
		     ->name( 'core.backend.roles.delete.permanent' );
		//------------------------------------------------
		Route::any( '/roles/read/{id}', 'RolesController@read' )
		     ->name( 'core.backend.roles.read' );
		//------------------------------------------------
		Route::any( '/roles/read/{id}/details', 'RolesController@readDetails' )
		     ->name( 'core.backend.roles.read.details' );
		//------------------------------------------------
		Route::post( '/roles/update', 'RolesController@update' )
		     ->name( 'core.backend.roles.update' );
		//------------------------------------------------
		Route::any( '/roles/read/{id}/stats', 'RolesController@stats' )
		     ->name( 'core.backend.roles.stats' );
		//------------------------------------------------
		Route::any( '/roles/read/{id}/permissions', 'RolesController@permissions' )
		     ->name( 'core.backend.roles.permissions' );
		//------------------------------------------------
	} );