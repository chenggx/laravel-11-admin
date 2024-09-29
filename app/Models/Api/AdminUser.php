<?php

namespace App\Models\Api;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class AdminUser extends BaseModel
{
    use HasFactory, HasApiTokens;

    protected $hidden = ['password'];

    protected static function boot()
    {
        parent::boot();
        $creatingOrUpdatingFunc = function (AdminUser $adminUser) {
            if ($adminUser->admin_user_id == 0) {
                // 将 path 设为 -
                $adminUser->path = '-';
            } else {
                // 将 path 值设为父类目的 path 追加父类目 ID 以及最后跟上一个 - 分隔符
                $adminUser->path = $adminUser->parent->path . $adminUser->admin_user_id . '-';
            }
        };

        // 监听 Category 的创建事件，用于初始化 path 和 level 字段值
        static::creating($creatingOrUpdatingFunc);
        static::updating($creatingOrUpdatingFunc);
    }
}
