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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('image_url')->default('https://images.unsplash.com/photo-1505866535066-ccebd6b2b98a');
            $table->text('title');
            $table->text('content');
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->unsignedBigInteger('users_id')->index();
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
