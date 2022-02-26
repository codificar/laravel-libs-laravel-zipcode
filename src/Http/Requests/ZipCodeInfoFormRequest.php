<?php

namespace Codificar\ZipCode\Http\Requests;

use Codificar\ZipCode\Http\Rules\CheckZipCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ZipCodeInfoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'zipcode' => ['required', 'string', new CheckZipCode($this->zipcode)]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */    
    public function messages()
    {
        return [
            'zipcode.required' => 'Zipcode is required.'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Remove máscaras do zipcode
        $this->zipcode = str_replace(['.','-'], "", $this->zipcode);

        // Realiza o merge das alterações
        $this->merge([
            'zipcode' => $this->zipcode,
        ]);
    }    

    /**
     * Caso a validação falhe, retorna os itens de erro
     * 
     * @return Json
     */
    protected function failedValidation(Validator $validator) 
    {   
        // Pega as mensagens de erro     
        $error_messages = $validator->errors()->all();

        // Exibe os parâmetros de erro
        throw new HttpResponseException(
        response()->json(
            [
                'success' => false,
                'error' => $error_messages[0],
                'error_code' => \ApiErrors::REQUEST_FAILED,
                'error_messages' => $error_messages,
            ]
        ));
    }
}