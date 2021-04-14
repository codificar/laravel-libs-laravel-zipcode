<?php

namespace Codificar\ZipCode\Lib;

use GuzzleHttp\Client as Guzzle;

use Codificar\ZipCode\Lib\InterfaceZipCode;
use Codificar\ZipCode\Factory\ZipCodeFactory;

class ZipCodeCepAberto implements InterfaceZipCode{
    
    public function getAddress($zipCode){
       
        try {
            $token = "Token token=639f483b151675817ee8e39aea195eb5";
            $requestUrl = "http://www.cepaberto.com/api/v3/";
    
            $client = new Guzzle([
                'base_uri' => $requestUrl,
                'headers' => ['Authorization' => $token],
                'connect_timeout' => 50,
                'exceptions' => false,
            ]);

            $param = "cep?cep=".$zipCode;
            $response = $client->request(
                'GET', $param
            )->getBody()->getContents(); 
            return $this->formatAddress(json_decode($response, true));
        } catch (\Throwable $th) {
            return [       
                "success" => false
            ];
        }	
    }

    private function formatAddress($zipCode){
       
        return [       
            "success" => true,
            "gateway" =>  ZipCodeFactory::CepAberto,           
            "zipcode" => $zipCode['cep'],
            "street" => $zipCode['logradouro'],
            "city" => $zipCode['cidade']['nome'],
            "district" => $zipCode['bairro'],
            "state" => $zipCode['estado']['sigla'],               
            "complement" => isset($zipCode['complemento']) ? $zipCode['complemento'] : null,
            "latitude" => isset($zipCode['latitude']) ? $zipCode['latitude'] : null,
            "longitude" => isset($zipCode['longitude']) ? $zipCode['longitude'] : null,   
        ];
    }
}