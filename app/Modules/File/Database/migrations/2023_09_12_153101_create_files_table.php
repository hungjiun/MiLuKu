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
        if ( !Schema::hasTable('files')) {
            Schema::create('files', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->bigInteger('member_id')->default(0);
                $table->string('type')->nullable();
                $table->string('server')->nullable();
                $table->string('path')->nullable();
                $table->string('name')->nullable();
                $table->string('original_name')->nullable();
                $table->integer('size')->default(0);
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
        Schema::dropIfExists('files');
    }
};
