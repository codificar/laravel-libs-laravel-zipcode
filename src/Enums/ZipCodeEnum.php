<?php
namespace Codificar\ZipCode\Enums;

use Codificar\ZipCode\Factory\ZipCodeFactory;

class ZipCodeEnum {
	/*
		|--------------------------------------------------------------------------
		| Enums of ZipCode Gateways
		|--------------------------------------------------------------------------
	*/
    const GatewayList = array(
	    array('value' => ZipCodeFactory::CepAberto,  'name' => 'Cep Aberto', 'required_key' => true),
		array('value' => ZipCodeFactory::Canducci,  'name' => 'Canducci', 'required_key' => false)
	);

}