<?php

namespace Codificar\ZipCode\Lib;

use GuzzleHttp\Client as Guzzle;

use Codificar\ZipCode\Lib\InterfaceZipCode;
use Codificar\ZipCode\Factory\ZipCodeFactory;
use Codificar\ZipCode\Exceptions\ZipCodeUnauthorizedKeyException;

class ZipCodeCepAberto implements InterfaceZipCode{

    private $isRedundancy;
    private $authKey;
    private $providerUrl;

    public function __construct($authKey, $isRedundancy = false)
    {
        $this->providerUrl = "https://www.cepaberto.com/api/v3/";
        $this->isRedundancy = $isRedundancy;
        $this->authKey = $authKey;
    }
    
    public function getAddress($zipCode){
       
        try {
            // 639f483b151675817ee8e39aea195eb5
            $token = "Token token=".$this->authKey;

            $client = new Guzzle([
                'base_uri' => $this->providerUrl,
                'headers' => ['Authorization' => $token],
                'connect_timeout' => 50,
                'exceptions' => false,
            ]);

            $param = "cep?cep=".$zipCode;
            $response = $client->request(
                'GET', $param
            ); 

            if($response->getStatusCode() === 403 || $response->getStatusCode() === 401) throw new ZipCodeUnauthorizedKeyException;
            
            return $this->formatAddress(json_decode($response->getBody()->getContents(), true));
        } catch (\Throwable $th) {
            \Log::error($th->getMessage().$th->getTraceAsString());
            return [       
                "success" => false
            ];
        }	
    }

    private function formatAddress($zipCode){
       
        return [       
            "success" => true,
            "redundancy" => $this->isRedundancy,
            "gateway" =>  ZipCodeFactory::CepAberto,           
            "zipcode" => preg_replace('/[^\p{L}\p{N}\s]/u', '', $zipCode['cep']),
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
