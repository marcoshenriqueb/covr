<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateChatRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'address' => 'required',
            'amount' => 'required|numeric',
            'currency' => 'required|size:3',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'operation' => 'required|boolean',
            'price' => 'required|numeric'
        ];
    }
}
