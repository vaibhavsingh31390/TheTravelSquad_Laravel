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
        Schema::create('database__posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('image_url');
            $table->char('category');
            $table->text('title');
            $table->text('content');
            $table->integer('like');
            $table->integer('dislike');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('database__posts');
    }
};
