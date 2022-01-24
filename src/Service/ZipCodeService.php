<?php


namespace Codificar\ZipCode\Service;
use Codificar\ZipCode\Factory\ZipCodeFactory;
use Codificar\ZipCode\Models\ZipCodeSettings;
use Codificar\ZipCode\Exceptions\ZipCodeNotFoundException;

class ZipCodeService {  
    
    public static function getAddressWithLatLng($zipCode){
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
