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
        Schema::create('post_images', function (Blueprint $table) {
            $table->id();
            //TODO: add ->onDelete('cascade') on post_id
            $table->foreignId('post_id')->constrained();
            $table->string('path', 200)->nullable();//images/recipes/pasta/spaghetti-aglio-e-olio.jpg
            $table->string('title', 200)->nullable();//title img attribute - no longer than 125 characters
            $table->string('alt', 200)->nullable();//alt img attribute - no longer than 125 characters
            $table->string('figcaption', 200)->nullable();//figcaption tag - no longer than 125 characters
            $table->string('position', 50)->nullable();//Here we place our image in a post - main/intro-end/methos/methos-end/recipe-card
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
        Schema::dropIfExists('post_images');
    }
};
