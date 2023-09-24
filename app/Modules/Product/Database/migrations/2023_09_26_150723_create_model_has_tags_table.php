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
        if (!Schema::hasTable('model_has_tags')) {
            Schema::create('model_has_tags', function (Blueprint $table) {
                $table->unsignedBigInteger('tag_id');
                $table->string('model_type');
                $table->unsignedBigInteger('model_id');
                $table->index(['model_id', 'model_type'], 'model_has_tags_model_id_model_type_index');

                $table->foreign('tag_id')
                    ->references('id') // product_tags id
                    ->on('product_tags')
                    ->onDelete('cascade');

                $table->primary(['tag_id', 'model_id', 'model_type'],
                    'model_has_tags_product_tags_model_type_primary');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_has_tags');
    }
};
