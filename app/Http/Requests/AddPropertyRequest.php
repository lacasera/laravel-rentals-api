<?php

namespace App\Http\Requests;

class AddPropertyRequest extends JsonRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'price' => 'required|numeric',
            'pricing_frequency' => 'required',
            'description' => 'required|string',
            'features' => 'required',
            'images' => 'required',
            'images.*.public_id' => 'required|string',
            'images.*.url' => 'required|string',
            'publish' => 'required'
        ];
    }
}
