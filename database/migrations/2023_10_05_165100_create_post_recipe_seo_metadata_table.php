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
        Schema::create('post_recipe_seo_metadata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained();
            $table->string('cooking_method')->nullable();
            // $table->string('prep_time'); // ISO 8601 duration format
            // $table->string('cooking_time'); // ISO 8601 duration format
            // $table->string('total_time'); // ISO 8601 duration format
            $table->smallInteger('prep_time_minutes')->unsigned()->nullable(); //Up to 65,535. Allow cooking time to be nullable
            $table->smallInteger('cooking_time_minutes')->unsigned()->nullable(); // Allow cooking time to be nullable
            $table->smallInteger('total_time_minutes')->unsigned()->nullable(); // Allow cooking time to be nullable
            $table->tinyInteger('yield')->unsigned()->nullable();
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
        Schema::dropIfExists('post_recipe_seo_metadata');
    }
};
