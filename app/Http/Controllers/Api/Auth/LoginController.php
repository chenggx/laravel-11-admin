<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Models\Api\AdminUser;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = AdminUser::query()->where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error('用户名或密码错误');
        }

        $token = $user->createToken('admin', [''], now()->addDays(7))->plainTextToken;

        return $this->success(['token' => $token]);
    }
}
