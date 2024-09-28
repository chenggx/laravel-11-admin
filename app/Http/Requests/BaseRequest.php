<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //自定义验证错误返回
    public function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();
        // $allErrors = $validator->errors()->all(); 所有错误
        // 验证错误
        $response = response()->json([
            'code' => 422,
            'message' => $error,
        ]);

        throw new HttpResponseException($response);
    }

    public function rules()
    {
        $currentRouteName = Route::currentRouteName();

        //api.role.store 转为 roleStore
        return call_user_func([$this, Str::camel(str_replace('.', '_', str_replace('api.', '', $currentRouteName)))]);
    }
}
