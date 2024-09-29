<?php

namespace App\Http\Requests\Api;

use App\Enum\Api\TypePermissionEnum;
use App\Http\Requests\BaseRequest;
use App\Rules\Api\PermissionNameRule;
use Illuminate\Validation\Rule;

class PermissionRequest extends BaseRequest
{
    public function permissionStore()
    {
        return [
            'title' => 'required|string',
            'pid' => [Rule::requiredIf(in_array($this->type, [TypePermissionEnum::PAGE->value, TypePermissionEnum::BUTTON->value])), 'exists:permissions,id'],
            'name' => ['required', 'string', new PermissionNameRule(), 'unique:permissions,name'],
            'type' => ['required', Rule::enum(TypePermissionEnum::class)],
            'sort' => 'required|integer|min:0',
            'icon' => [Rule::requiredIf($this->type === TypePermissionEnum::GROUP->value), 'nullable', 'string', 'max:50'],
            'path' => [Rule::requiredIf($this->type === TypePermissionEnum::BUTTON->value), 'nullable', 'string', 'max:50'],
            'method' => [Rule::requiredIf($this->type === TypePermissionEnum::BUTTON->value), 'nullable', 'string', 'max:50'],
            'hidden' => 'required|boolean',
        ];
    }
}
