<?php


namespace Codificar\ZipCode\Service;
use Codificar\ZipCode\Factory\ZipCodeFactory;
use Codificar\ZipCode\Exceptions\ZipCodeNotFoundException;

class ZipCodeService {  
    public function getAddressWithLatLng($zipCode){
        
        $zipCodeCepAberto = new ZipCodeFactory(ZipCodeFactory::CepAberto);        
        $response = $zipCodeCepAberto->createZipCode()->getAddress($zipCode);
        if($response['success']) return $response;
       
        $zipCodeCanducci = new ZipCodeFactory(ZipCodeFactory::Canducci);
        $response = $zipCodeCanducci->createZipCode()->getAddress($zipCode);
       
        if($response['success']) return $response;
       
        throw new ZipCodeNotFoundException;
    }
}
