<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Own\Auth\UserAuth as Auth;

class CreateMessageRequest extends Request
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
            'message' => 'required',
            'user_id' => 'required|numeric',
            'chat_id' => 'required|numeric'
        ];
    }
}
