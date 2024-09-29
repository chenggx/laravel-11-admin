<?php

namespace App\Models\Api;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends BaseModel
{
    use HasFactory;

    protected $guarded = ['id'];

    // 定义子权限关系
    public function children()
    {
        return $this->hasMany(Permission::class, 'pid', 'id');
    }

    // 递归加载所有层级的子权限
    public function recursiveChildren()
    {
        return $this->children()->with('recursiveChildren');
    }
}
