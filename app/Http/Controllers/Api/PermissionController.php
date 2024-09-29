<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PermissionRequest;
use App\Models\Api\Permission;

class PermissionController extends Controller
{
    public function store(PermissionRequest $request)
    {
        $data = $request->validated();

        $permission = Permission::query()->create($data);
        if (!$permission) {
            return $this->error();
        }

        return $this->success($permission);
    }

    public function index()
    {
        //获取所有权限，并显示为树形结构，具有无限极
        $permissions = Permission::query()
            ->where('pid', 0)
            ->with('recursiveChildren')
            ->get();

        return $this->success($permissions);
    }

    public function destroy(Permission $permission)
    {
        $hasChildren = $permission->children()->exists();

        if ($hasChildren) {
            return $this->error('请先删除子权限');
        }

        $res = $permission->delete();
        if (!$res) {
            return $this->error();
        }

        return $this->success();
    }

}
