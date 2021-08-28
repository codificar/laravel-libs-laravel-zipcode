<?php

namespace Codificar\ZipCode\Service;

use Codificar\ZipCode\Factory\ZipCodeFactory;
use Codificar\ZipCode\Models\ZipCodeSettings;
use Codificar\ZipCode\Exceptions\ZipCodeNotFoundException;
use Codificar\ZipCode\Http\Requests\ZipCodeRequest;
use Codificar\ZipCode\Http\Resources\ZipCodeResource;

use Canducci\Cep\Facades\Cep as Cep;
use Exception;

class ZipCodeService { 
    
    /**
	 * @api{post}/application/zip_code
	 * @apiDescription Recupera informações de um endereço a partir de seu cep
	 * @return Json
	 */
	public function getCepInfo($zip_code){
		$cepArray = [];
		try {
			$cepFind = Cep::find($zip_code);
			$cepInfo = $cepFind->toArray();
			$cepArray = $cepInfo->result();
		} catch(Exception $ex){
			return new ZipCodeResource(['cepArray' => $cepArray]);
		}

		return new ZipCodeResource(['cepArray' => $cepArray]);
	}

    public function getAddressWithLatLng($zipCode){
        $key = ZipCodeSettings::getZipCodeKey();
        $provider = ZipCodeSettings::getZipCodeProvider();    
        $response = self::findZipCode($zipCode, $provider, $key);
        if($response['success']) return $response;
       
        if(ZipCodeSettings::zipCodeHasRedundancy() == 1){     
            $redundancyKey = ZipCodeSettings::getZipCodeRedundancyKey();
            $redundancyProvider = ZipCodeSettings::getZipCodeRedundancyProvider();
            $response = self::findZipCode($zipCode, $redundancyProvider, $redundancyKey, true);
            if($response['success']) return $response;
        }
       
        throw new ZipCodeNotFoundException;
    }

    public static function findZipCode($zipCode, $provider, $key, $isRedundancy = false){   
        $zipCodeProvider = new ZipCodeFactory($provider);        
       
        return $zipCodeProvider->createZipCode($key, $isRedundancy)->getAddress($zipCode);
    }
}
