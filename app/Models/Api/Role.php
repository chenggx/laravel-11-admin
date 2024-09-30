<?php

namespace App\Models\Api;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends BaseModel
{
    use HasFactory;

    protected $guarded = ['id'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role_relation', 'role_id', 'permission_id')->withTimestamps();
    }
}
