<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\HTTP\Exceptions\HTTPResponseException;

class APIRequest extends FormRequest{
    protected function failedValidation(Validator $validator){
        throw new HTTPResponseException (response(['errors' => $validator -> errors()],400));
    }
}