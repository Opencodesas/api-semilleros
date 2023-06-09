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
        Schema::create('roles_activities', function (Blueprint $table) {
            $table->id();
            $table->string('description')->unique()->index()->comment('descripcion');
            $table->text('object')->comment('objeto');
            $table->tinyInteger('state')->default(1)->comment('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_activities');
    }
};
