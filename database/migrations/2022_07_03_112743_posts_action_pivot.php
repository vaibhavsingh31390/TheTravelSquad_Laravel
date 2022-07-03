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
        Schema::create('posts_action', function (Blueprint $table) {
            $table->id();
            $table->foreign('actions_id')->references('id')->on('actions')->onDelete('cascade');
            $table->boolean('state');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('actions_id')->index();
            $table->unsignedBigInteger('posts_id')->index();
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
            $table->unsignedBigInteger('users_id')->index();
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
        Schema::dropIfExists('posts_action');
    }
};
