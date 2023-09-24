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
        if (!Schema::hasTable('product_infos')) {
            Schema::create('product_infos', function (Blueprint $table) {
                $table->id();
                $table->string('num')->nullable()->comment('型號');
                $table->string('name')->nullable()->comment('商品名');
                $table->text('summary')->nullable()->comment('簡介');
                $table->longText('detail')->nullable()->comment('詳細資訊');
                $table->timestamps();
                $table->softDeletes();

                $table->engine = 'InnoDB';
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_infos');
    }
};
