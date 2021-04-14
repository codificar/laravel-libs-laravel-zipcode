<?php

namespace Codificar\ZipCode\Exceptions;
use Exception;

class ZipCodeNotFoundException extends Exception
{
    protected $message = 'Zip Code Not Found.';

    public function render(){
        return response()->json([
            'success' => false,
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 403);
    }
}
