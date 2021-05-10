<?php

namespace Codificar\ZipCode\Exceptions;
use Exception;

class ZipCodeUnauthorizedKeyException extends Exception
{
    protected $message = 'ZipCode Unauthorized Key.';

    public function render(){
        return response()->json([
            'success' => false,
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 403);
    }
}
