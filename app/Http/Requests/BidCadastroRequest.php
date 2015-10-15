<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Own\Auth\UserAuth as Auth;

class BidCadastroRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Auth $auth)
    {
        return $auth->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'operation' => 'required|boolean',
            'currency' => 'required|size:3',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'address' => 'max:255',
            'place_id' => 'max:255',
            'deadline' => 'date_format:d/m/Y|after:-1 day'
        ];
    }
}
