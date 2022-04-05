<?php 
Route::group(array('namespace' => 'Codificar\ZipCode\Http\Controllers'), function () {
    Route::group(['prefix' => '/libs/zipcode'], function () {
        Route::get('/info/{zipcode}', 'ZipCodeController@zipCodeInfo');    
    });
});
