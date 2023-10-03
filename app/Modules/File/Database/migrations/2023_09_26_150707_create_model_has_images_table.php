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
        if ( !Schema::hasTable('model_has_images')) {
            Schema::create('model_has_images', function (Blueprint $table) {
                $table->unsignedBigInteger('image_id');
                $table->string('model_type');
                $table->unsignedBigInteger('model_id');
                $table->index(['model_id', 'model_type'], 'model_has_images_model_id_model_type_index');

                $table->foreign('image_id')
                    ->references('id') // sys_files id
                    ->on('files')
                    ->onDelete('cascade');

                $table->primary(['image_id', 'model_id', 'model_type'],
                    'model_has_images_files_model_type_primary');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_has_images');
    }
};
