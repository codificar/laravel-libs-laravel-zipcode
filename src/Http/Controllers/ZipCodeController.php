<?php

namespace Codificar\ZipCode\Http\Controllers;

use App\Http\Controllers\Controller;
use Codificar\ZipCode\Http\Requests\ZipCodeInfoFormRequest;
use Codificar\ZipCode\Http\Resources\ZipCodeInfoResource;
use Codificar\ZipCode\Service\ZipCodeService;


use Exception;

class ZipCodeController extends Controller {
    
    /**
	 * @api {get} /api/v3/application/zip_code
	 * @apiDescription Obtém as informações por completo do zipcode informado
	 * @return Json
	 */
    public function zipCodeInfo(ZipCodeInfoFormRequest $request) 
    {	
		// Inicializa o array
		$zipCodeData = [];
		
		// Tenta fazer a busca
		try {
			// Busca as informações do zipcode informado
			$zipCodeData = ZipCodeService::getAddressWithLatLng($request->zipcode);

		} catch(Exception $ex){
			return new ZipCodeInfoResource([
				'cepArray'	=> $zipCodeData,
				'success'	=> false
			]);
		}
   
        // Retorna os dados
		return new ZipCodeInfoResource([
			'cepArray'	=> $zipCodeData,
			'success'	=> $zipCodeData['success']
		]);
	}

}
