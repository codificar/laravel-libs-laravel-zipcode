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
	public static function getZipCodeSettings (){
		return self::where('category', Config::get(self::ZipCodeCategory))->get();		
	}
}