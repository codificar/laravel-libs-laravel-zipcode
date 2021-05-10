<?php

namespace Codificar\ZipCode\Http\Controllers;

use stdClass;
use Exception;

use View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Codificar\ZipCode\Enums\ZipCodeEnum;
use Codificar\ZipCode\Models\ZipCodeSettings;

class ZipCodeSettingController extends Controller {

    public function create()
	{			
		//Settings Env
		$enviroment = 'admin';

		//Get Settings Data
		$list = ZipCodeSettings::getZipCodeSettings();
		// Format Data
		$model = $this->getViewModel($list);
	
		// Get Enum Values
		$enums = array(
			'zip_code_gateway_enum'	=>	ZipCodeEnum::GatewayList
		);

		// Get Page Title
		$title = ucwords(trans('customize.Settings'));
	
		return View::make('zipcode::settings.index')
			->with('enviroment', $enviroment)
			->with('enum', json_encode($enums))
			->with('title', $title)
			->with('page', 'settings')
			->with('model', json_encode($model));
	}

	public function store(Request $request)
	{			
		$params = $request->all();
		
		foreach ($params as $key => $value) {
			$settings = ZipCodeSettings::where('key', $value['key'])->first();
			
			if($settings){
				$settings->value = $value['value'];				
			}else{
				$settings = new ZipCodeSettings;
				$settings->key = $value['key'];
				$settings->value = $value['value'];
				$settings->tool_tip = $value['tool_tip'];
				$settings->page = $value['page'];
				$settings->category = $value['category'];
				$settings->sub_category = $value['sub_category'];
			}		

			$settings->save();
		}

	}

	private function getViewModel($list)
	{
		$model = new ModelObjectSettings();
      
		foreach ($list as $item) {
			$modelApplication = new ApplicationSettingsViewModel();
			$modelApplication->id = $item['id'];
			$modelApplication->key = $item['key'];
			$modelApplication->value = $item['value'];
			$modelApplication->tool_tip = $item['tool_tip'];
			$modelApplication->page = $item['page'];
			$modelApplication->category = $item['category'];
			$modelApplication->sub_category = $item['sub_category'];

			$model->{$item['key']} = $modelApplication;			
		}
		
		return $model;
	}

}

class ApplicationSettingsViewModel extends stdClass{
	public $id;
	public $key;
	public $value;
	public $tool_tip;
	public $page;
	public $category;
	public $sub_category;

	// constructor
	function __construct() {  }

}

class ModelObjectSettings extends stdClass {

	// constructor
	public function __construct() {  }

	public function __get($attribute){
		try {
			return $this->$attribute ;
		}
		catch (Exception $ex) {
			return new ApplicationSettingsViewModel() ;
		}
	}
}