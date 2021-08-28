<?php

namespace Codificar\ZipCode\Http\Requests;

use App\Http\Requests\BaseRequest;

class ZipCodeRequest extends BaseRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		$this->zip_code = str_replace(['.','-'],"",$this->zipcode);
		return [
			'zipcode' => 'required'
		];
	}

	/**
	 * Get the error messages.
	 *
	 * @return array
	 */
	public function messages() {
		return [];
	}
}
