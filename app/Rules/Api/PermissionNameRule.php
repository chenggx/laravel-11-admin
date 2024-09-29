<?php

namespace App\Rules\Api;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PermissionNameRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (!preg_match('/^[a-z]+(?:[A-Z][a-z]*)*$/', $value)) {
            $fail(':attribute 格式不正确');
        }
    }
}
