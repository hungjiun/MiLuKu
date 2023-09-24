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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('product_code')->nullable()->comment('系統識別碼');
                $table->integer('display_order')->default(0);
                $table->tinyInteger('open')->default(0);
                $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('products');
    }
};
