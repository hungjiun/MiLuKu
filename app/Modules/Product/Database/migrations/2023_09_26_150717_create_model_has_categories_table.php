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
        if (!Schema::hasTable('model_has_categories')) {
            Schema::create('model_has_categories', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id');
                $table->string('model_type');
                $table->unsignedBigInteger('model_id');
                $table->index(['model_id', 'model_type'], 'model_has_categories_model_id_model_type_index');

                $table->foreign('category_id')
                    ->references('id') // categories id
                    ->on('categories')
                    ->onDelete('cascade');

                $table->primary(['category_id', 'model_id', 'model_type'],
                    'model_has_categories_categories_model_type_primary');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_has_categories');
    }
};
