<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->comment('用户名')->unique();
            $table->string('password')->comment('密码');
            $table->unsignedBigInteger('admin_user_id')->default(0)->comment('创建者');
            $table->unsignedInteger('role_id')->default(0)->comment('角色');
            $table->unsignedInteger('path')->default(0)->comment('所属层级');
            $table->timestamp('start_time')->nullable()->comment('开始时间');
            $table->timestamp('end_time')->nullable()->comment('结束时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
};
