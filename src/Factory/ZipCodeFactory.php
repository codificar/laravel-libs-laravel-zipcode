<?php 

namespace Codificar\ZipCode\Factory;

use Codificar\ZipCode\Lib\ZipCodeCanducci;
use Codificar\ZipCode\Lib\ZipCodeCepAberto;

    class ZipCodeFactory
    {
        const Canducci       = 'canducci';
        const ViaCep         = 'via_cep';
        const CepAberto     = 'cep_aberto';
              
        private $provider;

        public function __construct($provider = self::Canducci)
        {
            $this->provider = $provider;
        }

        public function createZipCode($authKey, $isRedundancy = false)
        { 
            switch($this->provider)
            {
                case self::Canducci:
                    return(new ZipCodeCanducci($authKey, $isRedundancy));
                case self::CepAberto:
                    return(new ZipCodeCepAberto($authKey, $isRedundancy)); 
                default:
                    return(new ZipCodeCanducci($authKey, $isRedundancy));
            }
           
        }

    }