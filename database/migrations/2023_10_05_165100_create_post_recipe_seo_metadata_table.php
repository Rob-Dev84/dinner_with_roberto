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
            $table->foreignId('post_recipe_cooking_method_id')->nullable()->constrained('post_recipe_cooking_methods');// We don't need to specify the name table, but it's a good practice do it anyway
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
