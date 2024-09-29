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
        Schema::create('permissions', function (Blueprint $table) {
            $typePermissionValue = array_map(fn($case) => $case->value, \App\Enum\Api\TypePermissionEnum::cases());
            $enumValues = array_map(fn($case) => $case->value, \App\Enum\Api\MethodPermissionEnum::cases());

            $table->id();
            $table->unsignedBigInteger('pid')->default(0)->comment('上级 id')->index();
            $table->string('title')->comment('路由标题,中文');
            $table->string('name')->comment('路由名称,英文,名称不能重复,大驼峰格式')->unique();
            $table->enum('type', $typePermissionValue)->comment('类别:分组,页面,按钮');
            $table->unsignedInteger('sort')->comment('排序');
            $table->string('icon')->nullable()->comment('图标');
            $table->string('path')->nullable()->comment('路由地址');
            $table->enum('method', $enumValues)->nullable()->comment('api 方法');
            $table->boolean('hidden')->default(false)->comment('是否隐藏');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
