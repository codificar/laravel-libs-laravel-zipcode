<?php 
Route::group(array('namespace' => 'Codificar\ZipCode\Http\Controllers'), function () {
    Route::group(['prefix' => '/libs/zipcode/api'], function () {
        Route::get('/', 'ZipCodeController@getAppApiExample');    
    });
});