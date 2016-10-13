<?php

Route::group(['middleware' => 'web', 'prefix' => 'ph', 'namespace' => 'Modules\Ph\Http\Controllers'], function()
{
    Route::get('/', 'PhController@index');
});
