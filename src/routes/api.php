<?php 
Route::group(array('namespace' => 'Codificar\ZipCode\Http\Controllers'), function () {
    Route::group(['prefix' => '/libs/zipcode/info'], function () {
        Route::get('/', 'ZipCodeController@zipCodeInfo');    
    });
});