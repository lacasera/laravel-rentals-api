<?php

namespace App\Http\Requests;

use App\Rules\ValidState;

class UpdateStateRequest extends JsonRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'state' => ['required', 'string', new ValidState]
        ];
    }
}
