<?php
use Codificar\ZipCode\Factory\ZipCodeFactory;
use Codificar\ZipCode\Service\ZipCodeService;
// ViaCep
test('should be return a address with Cep Aberto Gateway', function () {
    $zipCode = '33030120';
    $provider = ZipCodeFactory::CepAberto;
    $key = "639f483b151675817ee8e39aea195eb5";
   
    $response = ZipCodeService::findZipCode($zipCode, $provider, $key);
   
    expect($response['success'])->toBeTrue();   
    expect($response['zipcode'])->toBe($zipCode);
});

test('should be return a success false with Cep Aberto Gateway', function () {
    $zipCode = '12345678';
    $provider = ZipCodeFactory::CepAberto;
    $key = "639f483b151675817ee8e39aea195eb5";
   
    $response = ZipCodeService::findZipCode($zipCode, $provider, $key);
   
    expect($response['success'])->toBeFalse();   
});
