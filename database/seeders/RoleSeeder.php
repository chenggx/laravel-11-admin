<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => '管理员', 'title' => 'admin'],
            ['name' => 'OEM', 'title' => 'oem'],
            ['name' => '代理商', 'title' => 'agent'],
            ['name' => '门店', 'title' => ' store'],
        ];

        \App\Models\Api\Role::query()->insert($roles);
    }
}
