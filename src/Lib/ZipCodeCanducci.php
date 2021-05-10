<?php

namespace Codificar\ZipCode\Lib;

use Canducci\Cep\Facades\Cep as Canducci;

use Codificar\ZipCode\Lib\InterfaceZipCode;
use Codificar\ZipCode\Factory\ZipCodeFactory;
use Codificar\Geolocation\Http\Controllers\PlacesServiceController;

class ZipCodeCanducci implements InterfaceZipCode{
    
    private $isRedundancy;
    private $authKey;

    public function __construct($authKey, $isRedundancy = false)
    {
        $this->isRedundancy = $isRedundancy;
        $this->authKey = $authKey;
    }

    public function getAddress($zipCode){
        try {
          
            $cepArray = Canducci::find($zipCode)->toArray()->result();
           
            if(empty($cepArray['cep'])) return ["success" => false]; 
           
            $fullAddress = $cepArray['logradouro'].", ".$cepArray['bairro']." ".$cepArray['localidade']." - ".$cepArray['uf'];
           
            $response = PlacesServiceController::geocode($fullAddress);
           
            if($response['success']){
                $response['data'];
                $cepArray['latitude'] =  $response['data']['latitude'];
                $cepArray['longitude'] =  $response['data']['longitude'];
            };
            
            return $this->formatAddress($cepArray);

        } catch (\Throwable $th) {
            return [       
                "success" => false
            ];
        }  
    }

    private function formatAddress($zipCode){
        return [       
            "success" => true,
            "redundancy" => $this->isRedundancy,
            "gateway" =>  ZipCodeFactory::Canducci,           
            "zipcode" => preg_replace('/[^\p{L}\p{N}\s]/u', '', $zipCode['cep']),
            "street" => $zipCode['logradouro'],
            "city" => $zipCode['localidade'],
            "district" => $zipCode['bairro'],
            "state" => $zipCode['uf'],               
            "complement" => isset($zipCode['complemento']) ? $zipCode['complemento'] : null,
            "latitude" => isset($zipCode['latitude']) ? $zipCode['latitude'] : null,
            "longitude" => isset($zipCode['longitude']) ? $zipCode['longitude'] : null,   
        ];
    }
}