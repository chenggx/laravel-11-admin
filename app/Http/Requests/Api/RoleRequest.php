<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest;

class RoleRequest extends BaseRequest
{
    public function attributes()
    {
        return [
            'name' => '角色名',
            'title' => '角色标记',
        ];
    }

    public function roleStore(): array
    {
        return [
            'name' => 'required|string|max:255',
            'title' => 'required|unique:roles,title'
        ];
    }

    public function roleIndex(): array
    {
        return [
            'size' => 'integer|min:1',
            'page' => 'integer|min:1'
        ];
    }

    public function roleUpdate(): array
    {
        return [
            'name' => 'required|unique:roles,title',
        ];
    }

}
