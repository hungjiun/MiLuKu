<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_log_inputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('operation_log_id');
            $table->foreign('operation_log_id', 'oli_oli_fk')
                ->references('id')
                ->on('operation_logs')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->text('input');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_log_inputs');
    }
};
