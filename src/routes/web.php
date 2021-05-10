<?php 
Route::group(array('namespace' => 'Codificar\ZipCode\Http\Controllers'), function () {
    Route::group(['prefix' => '/admin/libs/zipcode'], function () {
        Route::get('/settings', array('as' => 'adminZipCodeSettingCreate', 'uses' => 'ZipCodeSettingController@create'));
        Route::post('/settings', array('as' => 'adminZipCodeSettingStore', 'uses' => 'ZipCodeSettingController@store'));
    });
});
// Route::group(array('namespace' => 'Codificar\ZipCode\Http\Controllers'), function () {
//     Route::group(['prefix' => '/libs/zipcode'], function () {
//         Route::get('/settings', 'ZipCodeSettingController@create');    
//     });
// });