<?php

namespace Codificar\ZipCode\Models;

//External Uses
use Settings;
use Illuminate\Support\Facades\Config;

class ZipCodeSettings extends Settings {
	const ZipCodeCategory = 'enum.category.ZipCode';

	/**
	 * Get Category
	 *
	 * @return Number
	*/
	public static function getZipCodeCategory (){
		return Config::get(self::ZipCodeCategory);		
	}

	/**
	 * Get Category Settings
	 *
	 * @return Object
	*/
	public static function getZipCodeSettings(){
		return self::where('category', Config::get(self::ZipCodeCategory))->get();		
	}

	public static function zipCodeFindByKey($key)
	{
		$settings = self::where('key', $key)->first();

		if ($settings)
			return $settings->value;
		else
			return null;
	}

	public static function getZipCodeProvider(){
		return self::zipCodeFindByKey('zipcode_provider');		
	}
	public static function getZipCodeKey(){
		return self::zipCodeFindByKey('zipcode_key');		
	}

	public static function zipCodeHasRedundancy(){ 
		return self::zipCodeFindByKey('zipcode_redundancy');		
	}

	public static function getZipCodeRedundancyProvider(){
		return self::zipCodeFindByKey('zipcode_redundancy_provider');		
	}
	public static function getZipCodeRedundancyKey(){
		return self::zipCodeFindByKey('zipcode_redundancy_key');		
	}
}