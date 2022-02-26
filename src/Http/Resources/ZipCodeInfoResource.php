<?php

namespace Codificar\ZipCode\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ZipCodeInfoResource
 *
 * @package UberClone
 *
 * @OA\Schema(
 *      schema="ZipCodeInfoResource",
 *      type="object",
 *      description="Response for zipcode API",
 *      title="ZipCode Resource",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/ZipCodeInfoResource"),
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
class ZipCodeInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		if ((boolean) $this['success'] == true) {
			return [
				'success' => (boolean) $this['success'],
				'result' => [
					'redundancy'	=> (string) $this['cepArray']['redundancy'],
					'gateway'		=> (string) $this['cepArray']['gateway'],
					'zipcode'		=> (string) $this['cepArray']['zipcode'],
					'logradouro'	=> (string) $this['cepArray']['street'],
					'localidade'	=> (string) $this['cepArray']['city'],
					'uf'			=> (string) $this['cepArray']['state'],
					'bairro'		=> (string) $this['cepArray']['district'],
					'latitude'		=> (float) $this['cepArray']['latitude'],
					'longitude'		=> (float) $this['cepArray']['longitude']
				]
			];
		} else {
			return [
				'success' => (boolean) $this['success']
			];
		}
    }
}