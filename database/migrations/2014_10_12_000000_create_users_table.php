<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('account');
                $table->string('password');
                $table->rememberToken();
                $table->string('name', 50)->nullable()->comment('暱稱');
                $table->string('email')->nullable();
                $table->string('mobile')->nullable();
                $table->tinyInteger('status')->default(1)->comment('帳號狀態，0:未知、1:停用、2:啟用');
                $table->string('note')->nullable()->comment('備註');
                $table->unsignedBigInteger('created_by');
                $table->unsignedBigInteger('updated_by');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
