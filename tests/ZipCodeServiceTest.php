<?php
use Codificar\ZipCode\Service\ZipCodeService;
use Codificar\ZipCode\Exceptions\ZipCodeNotFoundException;

test('should be return a address with zipcode', function () {
    $zipcode = 33030120;
    $response = ZipCodeService::getAddressWithLatLng($zipcode);
   
    expect($response['success'])->toBeTrue();   
    expect($response['zipcode'])->toBe("33030120");
});

test('should be throws ZipCodeNotFoundException with pass invalid zipcode', function () {
    $zipcode = 12345678;
    ZipCodeService::getAddressWithLatLng($zipcode);
})->throws(ZipCodeNotFoundException::class);
