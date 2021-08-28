<?php

namespace Codificar\ZipCode\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ZipCodeResource
 *
 * @package UberFretes
 *
 * @author  Álvaro Oliveira <alvaro.oliveira@codificar.com.br>
 *
 * @OA\Schema(
 *      schema="ZipCodeResource",
 *      type="object",
 *      description="Response for zipcode API",
 *      title="ZipCode Resource",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/ZipCodeResource"),
 *          @OA\Schema(
 *              required={"success"},
 *              @OA\Property(property="success", format="boolean", type="boolean"),
 *              @OA\Property(property="result", type="object"),
 *              @OA\Property(property="error", type="string"),
 *              @OA\Property(property="erro_code", type="integer")
 *          )
 *      }
 * )
 */
class ZipCodeResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		if($this['cepArray'] != null and count($this['cepArray']) > 0){
			return [
				'success' => true,
				'result' => $this['cepArray']
			];
		} else {
			return [
				'success' => false,
				'error' => 'Cep inválido',
				'error_code' => 403
			];
		}
	}
}
