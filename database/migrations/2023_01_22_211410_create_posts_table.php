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
            $table->foreignId('user_id')->constrained();
            $table->string('title', 100);//don't go over 55-60 characters
            $table->string('slug', 100);//don't go over 55-60 characters
            $table->string('meta_title', 100)->nullable();//best 30/60 characters
            $table->string('meta_description', 200)->nullable();//best 140 characters
            // $table->string('img_link', 200)->nullable();//best 140 characters
            $table->text('intro')->nullable();//for recipe intro
            $table->text('note')->nullable();//for recipe note
            $table->boolean('published')->default(0);
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
