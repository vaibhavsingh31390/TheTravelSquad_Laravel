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
        Schema::create('database__categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('category_Menu');
            $table->unsignedBigInteger('database__posts_id')->index();
            $table->foreign('database__posts_id')->references('id')->on('database__posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('database__categories');
    }
};
