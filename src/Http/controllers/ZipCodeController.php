<?php

namespace Codificar\ZipCode\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Resource
use Codificar\ZipCode\Http\Resources\TesteResource;

class ZipCodeController extends Controller {

    public function getAppApiExample()
    {
        $teste = "Variavel teste";
        
        // Return data
		return new TesteResource([
			'teste' => $teste
		]);
    }

}