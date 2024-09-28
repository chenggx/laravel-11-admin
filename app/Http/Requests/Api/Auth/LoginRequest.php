<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
        ];
    }

    public function authLogin()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
