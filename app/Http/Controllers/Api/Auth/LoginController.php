<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\Api\PermissionResource;
use App\Models\Api\AdminUser;
use App\Models\Api\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = AdminUser::query()->where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error('用户名或密码错误');
        }

        $token = $user->createToken('admin', ['*'], now()->addDays(7))->plainTextToken;

        return $this->success(['token' => $token]);
    }

    public function asyncRoutes(Request $request)
    {
        $user = $request->user();

        if ($user->id == 1) {
            $permissions = Permission::query()
                ->where('pid', 0)
                ->with('recursiveChildren')
                ->get();
        } else {
            $permissions = [];
        }

        //格式化输出 $permission，使用递归的方式



        return $this->success(PermissionResource::collection($permissions));
    }

    public function logout(Request $request)
    {
        $admin = $request->user();
        $res = $admin->tokens()->delete();
        if (!$res) {
            return $this->error('退出失败');
        }

        return $this->success();
    }
}
