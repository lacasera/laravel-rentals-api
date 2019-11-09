<?php
/**
 * Created by PhpStorm.
 * User: lacasera
 * Date: 10/17/19
 * Time: 1:53 PM
 */

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

abstract class JsonRequest extends FormRequest
{
    abstract public function rules ();
    public function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'results' => $errors
        ], 400));
    }
}