<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RoleRequest;
use App\Models\Api\Role;

class RoleController extends Controller
{
    public function store(RoleRequest $request)
    {
        $data = $request->validated();

        $role = Role::query()->create($data);

        if (!$role) {
            return $this->error();
        }

        return $this->success();
    }

    public function index(RoleRequest $request)
    {
        $size = $request->input('size', 1);
        $page = $request->input('page', 1);

        $list = Role::query()->paginate($size, ['*'], 'page', $page);

        return $this->success($list);
    }

    public function show(Role $role)
    {
        return $this->success($role);
    }

    public function update(Role $role, RoleRequest $request)
    {
        $data = $request->validated();

        $role->update($data);

        return $this->success();

    }

    public function destroy(Role $role)
    {
        //管理员角色禁止删除
        if ($role->id == 1) {
            return $this->error('管理员角色禁止删除');
        }
        //TODO 删除角色，删除角色和菜单的关联关系
        //TODO 删除角色和用户关联关系

        $role->delete();

        return $this->success();
    }
}
