<?php

Route::group(['middleware' => 'web', 'prefix' => 'phseller', 'namespace' => 'Modules\PhSeller\Http\Controllers'], function()
{
    Route::get('/', 'PhSellerController@index');
});
