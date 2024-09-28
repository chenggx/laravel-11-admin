<?php

namespace Database\Seeders;

use App\Models\Api\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Api\AdminUser::factory(10)->create();

        AdminUser::query()->where('id', 1)->update(['username' => 'admin', 'role_id' => 1]);
    }
}
